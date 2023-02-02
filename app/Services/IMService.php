<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Carbon\Carbon;

class IMService
{

    private $_app_key;
    private $_app_secret;
    private $_admin;
    private $_url = 'https://console.tim.qq.com/v4/';

    public function __construct()
    {
        $this->_app_key = env('TENCENT_IM_APP_KEY', '');
        $this->_app_secret = env('TENCENT_IM_APP_SECRET', '');
        $this->_admin = 'administrator';
    }

    // 创建ccid
    private function createAccid()
    {
        return md5(sha1(Str::random(32) . Carbon::now()->timestamp));
    }

    // 生成usersig
    public function genUserSig($accid)
    {
        $tencent_serv = new TLSSigAPIv2($this->_app_key, $this->_app_secret);
        return $tencent_serv->genUserSig($accid);
    }

    // 创建im账号
    public function createAccount($user_name, $avatar = '', $prefix = '')
    {
        $accid = $this->createAccid();
        $admin_sig = $this->genUserSig($this->_admin);
        $url = $this->_url . 'im_open_login_svc/account_import?sdkappid=' . $this->_app_key
                           . '&identifier=' . $this->_admin . '&usersig=' . $admin_sig . '&random=' . random_int(1, 9999) . '&contenttype=json';

        $response = $this->_http($url, [
            'Identifier' => $prefix . $accid,
            'Nick' => $user_name,
            'FaceUrl' => $avatar,
        ]);

        if ($response['ErrorCode'] == 0)
            return ['accid' => $prefix . $accid, 'user_name' => $user_name, 'avatar' => $avatar];

        return ['status' => 400,'message' => 'Im注册失败'];
    }
    
    // 判断用户在线状态
    public function getOnlineStatus($user_ids)
    {
        $admin_sig = $this->genUserSig($this->_admin);
        $url = $this->_url . 'openim/query_online_status?sdkappid=' . $this->_app_key
                           . '&identifier=' . $this->_admin . '&usersig=' . $admin_sig . '&random=' . random_int(1, 9999) . '&contenttype=json';
        $response = $this->_http($url, [
            'To_Account' => $user_ids,
        ]);
        if ($response['ErrorCode'] == 0)
            return $response['QueryResult'];
    }


    public function getMessage($from, $to, $start_time, $end_time, $end_flag = '', $res = [])
    {
        $admin_sig = $this->genUserSig($this->_admin);
        $url = $this->_url . 'openim/admin_getroammsg?sdkappid=' . $this->_app_key
                           . '&identifier=' . $this->_admin . '&usersig=' . $admin_sig . '&random=' . random_int(1, 9999) . '&contenttype=json';
        $response = $this->_http($url, [
            'Operator_Account' => $from,
            'Peer_Account' => $to,
            'MaxCnt' => 50,
            'MinTime' => $start_time,
            'MaxTime' => $end_time,
            'LastMsgKey' => $end_flag,
        ]);

        // 只显示100条
        return $response['MsgList'];

        // 显示全部
        /*array_unshift($res, $response['MsgList']);
        if($response['ErrorCode'] == 0 && $response['Complete'] == 0){
            return $this->getMessage($from, $to, $start_time, $response['LastMsgTime'], $response['LastMsgKey'], $res); 
        }else{
            return $res;
        }*/
    }

    protected function _http($url, $body)
    {
        $client = new Client();

        try {
            $response = $client->post($url, ['json' => $body]);
        } catch (\Exception $e){
            LOG::info('IM 服务异常');
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
