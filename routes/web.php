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

Route::middleware(['auth'])->group(function() {
    Route::resource('topics', 'TopicsController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
    Route::get('users/drafts', 'TopicsController@indexDrafts')->name('users.drafts');
    Route::get('users/privateTopic', 'TopicsController@privateTopic')->name('users.privateTopic');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
    Route::match(['put', 'post', 'patch'], 'users/storeDraft/{topic?}', 'TopicsController@storeDraft')->name('topics.storeDraft');

    Route::get('subscribe', 'SubscribeController@index')->name('subscribe.index');
    Route::post('subscribe', 'SubscribeController@subscribe')->middleware(['verifyEmail'])->name('subscribe.subscribe');
    Route::post('unsubscribe', 'SubscribeController@unsubscribe')->middleware(['verifyEmail'])->name('subscribe.unsubscribe');

    Route::get('im','ImController@index')->name('im');
    Route::get('get-user-sig', 'ImController@getUserSig');
    Route::get('get-user-status', 'ImController@getUserStatus');
    Route::get('messages', 'ImController@messages')->name('im-message');

    //展示上传列表
    Route::get('file/upload', 'FileUploadController@index')->name('file.index');
});

Route::get('/', 'TopicsController@index')->name('root');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('topics/{search?}', 'TopicsController@index')->name('topics.index');
Route::get('tags/{search?}', 'TopicsController@tagsSearch')->name('topics.tags');
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->middleware('create.accid');

//文件上传接口
Route::post('file/upload', 'FileUploadController@upload')->name('file.upload');
// 文件列表
Route::get('file/list', 'FileUploadController@list')->name('file.list');
// 文件下载
Route::get('file/download', 'FileUploadController@download')->name('file.download');
Route::get('file/delete', 'FileUploadController@delete')->name('file.delete');

/*Route::get('/test-socket', function () {
    event(new \App\Events\ChatEvent('Say Hello')); // 触发一下即可
    return view('welcome');
});

Route::any('im/im-callback',function(Request $request){
    \Log::info('im request====' . json_encode(\Request::all()));
});*/

