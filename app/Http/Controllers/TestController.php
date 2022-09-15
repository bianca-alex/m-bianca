<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //
    public function index()
    {
        if(Redis::llen('lottery') < 10){
            // 成功
            sleep(2);
            Redis::lpush('lottery','%'.microtime());
            sleep(2);
            echo 'success';
	    }else{
            // 失败
            echo 'fail';
	    }
    }
}
