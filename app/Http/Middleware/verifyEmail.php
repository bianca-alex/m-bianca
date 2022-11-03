<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class verifyEmail
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
        if($request->email != \Auth::user()->email){
            return redirect()->route('subscribe.index')
                             ->with('warning', '邮箱验证失败');
        }
        return $next($request);
    }
}
