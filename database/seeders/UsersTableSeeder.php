<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 96; $i++) {
            DB::table('users')->insert([
                'name' => 'サンプルユーザー' . $i, // 連番を割り振る
                'email' => 'sample' . $i . '@example.com', // 各ユーザーに一意のメールアドレスを割り当てる
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // 実際にはより安全なパスワードを設定してください

            ]);
        }
    }
}
