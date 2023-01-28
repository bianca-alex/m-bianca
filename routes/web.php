<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImController;

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

    Route::get('im', function(){
        $user = \Auth::user();
        $accid = $user->accid;
        $users = \App\Models\User::all();

        //$users = \App\Models\User::Where('accid','<>','')->pluck('accid');
        //$im = new App\Services\IMService();
        //$res = $im->getOnlineStatus($users->toArray());
        $users = $users->except([$user->id]);
        return view('im.index',compact('accid','users'));
    });
    Route::get('get-user-sig', [ImController::class, 'getUserSig']);
});

Route::get('/', 'TopicsController@index')->name('root');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('topics/{search?}', 'TopicsController@index')->name('topics.index');
Route::get('tags/{search?}', 'TopicsController@tagsSearch')->name('topics.tags');
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->middleware('create.accid');

Route::get('/test-socket', function () {
    event(new \App\Events\ChatEvent('Say Hello')); // 触发一下即可
    return view('welcome');
});
