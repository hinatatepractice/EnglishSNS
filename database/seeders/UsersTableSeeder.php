<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder         //ユーザー初期データ
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'screen_name'    => 'test_user1',
            'name'           => 'Eng1',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test1' .'@test1.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user2',
            'name'           => 'Eng2',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test2' .'@test2.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user3',
            'name'           => 'Eng3',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test3' .'@test3.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user4',
            'name'           => 'Eng4',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test' .'@test4.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user5',
            'name'           => 'Eng5',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test' .'@test5.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user6',
            'name'           => 'Eng6',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test6' .'@test6.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user7',
            'name'           => 'Eng7',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test7' .'@test7.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user8',
            'name'           => 'Eng8',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test8' .'@test8.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user9',
            'name'           => 'Eng9',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test9' .'@test9.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('users')->insert([
            'screen_name'    => 'test_user10',
            'name'           => 'Eng10',
            'profile_image'  => 'https://placehold.jp/50x50.png',
            'email'          => 'test10' .'@test10.com',
            'password'       => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
