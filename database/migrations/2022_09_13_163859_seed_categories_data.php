<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name'        => '博客',
                'description' => '技术点记录',
            ],
            [
                'name'        => '分享',
                'description' => 'share',
            ],
            [
                'name'        => 'Code',
                'description' => '代码片段',
            ],
            [
                'name'        => 'Life',
                'description' => '生活',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
