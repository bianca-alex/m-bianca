<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Topic;
use App\Models\Subscribe;
use Carbon\Carbon;
use App\Mail\SendSubscribers;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        //\Cookie::queue('m_bianca_Abtest', $_SERVER['URL_PREFIX'], 3600);
        //echo \Cookie::get('m_bianca_Abtest');


        //session(['key' => 'value']);
        //var_dump($request->session()->all());

    }
}
