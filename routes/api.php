<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;

use App\Http\Controllers\Api\VerificationCodesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->name('api.v1.')->group(function(){

    Route::post('verificationCodes', [VerificationCodesController::class, 'store'])
        ->name('verificationCodes.store');
    // 用户注册
    Route::post('users', [UsersController::class, 'store'])
        ->name('users.store');
});
