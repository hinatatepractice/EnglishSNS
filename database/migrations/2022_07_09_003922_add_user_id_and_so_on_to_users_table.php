<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration   //uersテーブルにアカウント名(仕様変更)、ユーザー名、プロフィール画像カラムを追加
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('screen_name')->unique()->comment('アカウント名'); //アカウント名
            $table->string('name')->comment('ユーザー名');   //ユーザー名
            $table->string('profile_image')->nullable()->comment('プロフィール画像'); //プロフィール画像 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name'); //元々あったnameカラムは削除
            $table->dropColumn('screen_name');
            $table->dropColumn('name');
            $table->dropColumn('profile_image');
        });
    }
};
