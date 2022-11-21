<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerificationCodeRequest;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{
    //
    public function store(VerificationCodeRequest $request, EasySms $easysms)
    {
        $phone = $request->phone;
        $code = str_pad(random_int(1,9999), 4, 0, STR_PAD_LEFT);

        if(!app()->environment('production')){
            $code = 8888;
        }else{
            try {
                $result = $easysms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }
        $key = Str::random(15);

        $cacheKey = 'verificationCode_'.$key;
        $expiredAt = now()->addMinutes(5);

        \Cache::put($cacheKey, ['phone' => $phone, 'code' => $code], $expiredAt);

        return response()->json([
            'key' => $key,
            'expired_at' =>$expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
