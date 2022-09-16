<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SentenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['content' => '生命是黑暗中闪烁的光'],
            ['content' => '不要着急,最好的总会在最不经意的时候出现'],
            ['content' => '内心强大,才能道歉,但必须更强大,才能原谅'],
            ['content' => '我不知将去何方,但我已在路上'],
            ['content' => '迷倒我的不是彩虹,而是在我面前,看彩虹的人'],
            ['content' => '我们会在原来的世界相遇吗，会的，一定会，重要的人就算走到哪里都不会忘记'],
            ['content' => '每天都是新的一天，有好运比什么都强'],
            ['content' => '生活总是让我们遍体鳞伤,但到后来,那些受伤的地方一定会变成我们最强壮的地方'],
            ['content' => '一个人可以被毁灭,但不能被打败'],
            ['content' => '太阳落山我不怕,直对着看也不觉眼前发黑。其实夕阳同样强烈,只是早上的光太刺眼'],
        ];

        \DB::table('good_sentences')->insert($data);
    }
}
