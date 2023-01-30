<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IMService;

class ImController extends Controller
{
    //
    /*public function getUserSig()
    {
        $im = new IMService();
        $user = \Auth::user();
        return ['status' => 200, 'usersig' => $im->genUserSig($user->accid)];
    }*/
}
