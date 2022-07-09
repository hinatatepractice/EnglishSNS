<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('comments')->insert([
                'user_id' => 1,
                'tweet_id' => $i,
                'text' => 'これはテストコメント' .$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}