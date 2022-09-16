<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $data = \DB::table('good_sentences')->inRandomOrder()->first();
        \View::share('sentence', $data->content);
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
