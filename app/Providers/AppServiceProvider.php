<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redis;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;

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
            if (Redis::get('sentence')) {
                $data = Redis::get('sentence');
            } else {
                $data = \DB::table('good_sentences')->inRandomOrder()->first()->content;
                Redis::set('sentence', $data, 'ex', 60 *10);
            }
            \View::share('sentence', $data);
        });

        \Illuminate\Pagination\Paginator::useBootstrap();

        /**
          * 扩展 MySqlGrammar
         */
        MySqlGrammar::macro('whereFulltext', function(QueryBuilder $query, $where) {
            $columns = implode(',', array_map(function($column) use ($query){
                return $this->wrap($column);
            }, $where['columns']));

            $value = $this->parameter($where['value']);

            $mode = ($where['options']['mode'] ?? []) === 'boolean'
                ? ' in boolean mode'
                : ' in natural language mode';

            $expanded = ($where['options']['expanded'] ?? []) && ($where['options']['mode'] ?? []) !== 'boolean'
                ? ' with query expansion'
                : '';

           return "match ({$columns}) against (".$value."{$mode}{$expanded})";
        });

        /**
        * 扩展 Builder
        */
        Builder::macro('whereFullText', function($columns, $value, array $options = [], $boolean = 'and') {
            $type = 'Fulltext';

            $columns = (array) $columns;

            $this->wheres[] = compact('type', 'columns', 'value', 'options', 'boolean');

            $this->addBinding($value);

            return $this;
        });
        \URL::forceScheme('https');
    }
}
