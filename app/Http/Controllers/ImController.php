<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IMService;

class ImController extends Controller
{
    //
    public function index()
    {
        $user = \Auth::user();
        $accid = $user->accid;
        $users = \App\Models\User::all();

        //$users = \App\Models\User::Where('accid','<>','')->pluck('accid');
        //$im = new App\Services\IMService();
        //$res = $im->getOnlineStatus($users->toArray());
        //dd($res);
        $users = $users->except([$user->id]);
        return view('im.index',compact('accid','users'));
    }

    public function getUserSig()
    {
        $im = new IMService();
        $user = \Auth::user();
        return ['status' => 200, 'usersig' => $im->genUserSig($user->accid)];
    }
}
