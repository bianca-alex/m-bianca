<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成数据集合
        //User::factory()->count(10)->create();
        // 单独处理第一个用户的数据
        /*$user = User::find(1);
        $user->name = 'bianca';
        $user->email = 'bianca.lk.alex@outlook.com';
        $user->save();*/

        User::create([
                'name' => 'bianca',
                'email' => 'bianca.lk.alex@outlook.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$v0r35O6u3tTOc.46OjhPTuIyoJ8szxuFzIx5BtN7Ab/eeKuItz7iq', // password => alex
                'remember_token' => \Str::random(10),
            ]);
    }
}
