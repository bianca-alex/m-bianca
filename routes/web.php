<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test','TestController@index');


Route::get('/', 'TopicsController@index')->name('root');
Route::resource('topics', 'TopicsController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']])
        ->middleware('checkAdmin');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('topics', 'TopicsController@index')->name('topics.index');

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
