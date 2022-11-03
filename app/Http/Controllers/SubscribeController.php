<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    //
    public function index()
    {
        // 如果当前用户已经订阅，则显示取消订阅
        $id = \Auth::id();
        $subscribe = Subscribe::where('user_id',$id)->first(['flag']);
        $subscribe_flag = 0;
        if($subscribe && $subscribe->flag == 1){
            $subscribe_flag = 1;
            return view('subscribes.subscribe', compact('subscribe_flag')); 
        }
        return view('subscribes.subscribe', compact('subscribe_flag')); 
    }

    public function subscribe(Request $request)
    {
        $id = \Auth::id();
        $subscribe = Subscribe::where('user_id',$id)->update(['flag' => 1]);
        return redirect()->route('root')->with('success', '订阅成功');
    }

    public function unsubscribe(Request $request)
    {
        $id = \Auth::id();
        $subscribe = Subscribe::where('user_id',$id)->update(['flag' => 0]);
        return redirect()->route('root')->with('success', '取消订阅成功');
    }
}
