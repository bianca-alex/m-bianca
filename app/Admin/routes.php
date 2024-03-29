<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('topics', TopicsController::class);
    $router->resource('good-sentences', SentencesController::class);
    $router->resource('users', UsersController::class);
    $router->resource('tags', TagController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('subscribes', SubscribeController::class);
});
