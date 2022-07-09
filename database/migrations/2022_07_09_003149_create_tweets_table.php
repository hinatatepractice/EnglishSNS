<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');                      //外部キー制約方法１(usersのid)はデフォルトでunsignedBigInteger型なのでこっちも合わせる
            // $table->foreign('user_id')->references('id')->on('users');  
            $table->foreignId('user_id')->constrained()->comment('ユーザID'); //外部キー制約方法２laravel7.x以降(tweetsテーブルのuser_id -> usersテーブルのuserid) <- constrainedで参照したいであろう外部のカラムを勝手に判断してくれる
            $table->string('text')->comment('ツイート本文');
            $table->softDeletes(); //論理削除
            $table->timestamps();
    
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
