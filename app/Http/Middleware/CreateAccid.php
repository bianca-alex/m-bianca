<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CreateAccid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * 在响应发送到浏览器后处理任务。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function terminate($request, $response)
    {
        // ...
        $user = \Auth::user();
        \Log::info('login in ' . $user);
        if (!$user->accid) {
            $res = (new \App\Services\IMService())->createAccount($user->name);
            \Log::info('res: ' . $res['accid']);
            $user->accid = $res['accid'];
            $user->save();
        }

    }
}
