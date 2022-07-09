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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('ユーザID'); //外部キー
            $table->foreignId('tweet_id')->constrained()->comment('ツイートID'); //外部キー
            $table->string('text')->comment('コメント本文');
            $table->softDeletes(); //論理削除
            $table->timestamps();
    
            $table->index(['user_id', 'tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
