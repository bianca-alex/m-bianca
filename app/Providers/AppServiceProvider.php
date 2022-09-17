<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \View::composer('*', function ($view) {
        //
            if (session()->has('sentence')) {
                $data = session()->get('sentence');
            } else {
                $data = \DB::table('good_sentences')->inRandomOrder()->first()->content;
                session()->put('sentence', $data);
            }
            \View::share('sentence', $data);
        });

        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
