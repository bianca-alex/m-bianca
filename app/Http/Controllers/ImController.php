<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IMService;
use Carbon\Carbon;

class ImController extends Controller
{
    //
    public function index()
    {
        $user = \Auth::user();
        $accid = $user->accid;
        $query = \App\Models\User::where('accid','<>','')->where('id','<>',$user->id)->orderBy('id');

        $users = $query->pluck('name');
        $accids = $query->pluck('accid');

        $im = new \App\Services\IMService();

        $res = $im->getOnlineStatus($accids->toArray());
        $res = $users->combine($res);
        return view('im.index',compact('res','accid'));
    }

    public function getUserSig()
    {
        $im = new IMService();
        $user = \Auth::user();
        return ['status' => 200, 'usersig' => $im->genUserSig($user->accid)];
    }

    public function getUserStatus(Request $request)
    {
        $accid = $request->accid;
        $im = new \App\Services\IMService();
        $res = $im->getOnlineStatus(explode(' ', $accid));
        return ['status' => 200, 'online' => $res[0]['Status']];
    }

    public function messages(Request $request)
    {
        // 一周之类的聊天记录
        $user = \Auth::user();
        $accid = $user->accid;
        $start_time = Carbon::now()->startOfWeek()->timestamp;
        $end_time = Carbon::now()->timestamp;
        //echo Carbon::now();
        $im = new \App\Services\IMService();
        $res = $im->getMessage($accid, $request->accid, $start_time, $end_time);
        //dd($res);
        $user_to_name = $request->user_name;
        $user_from_name = $user->name;
        return view('im.message',compact('res', 'accid', 'user_from_name', 'user_to_name'));
    }
}
