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
        Schema::create('fovorites', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->comment('ユーザID'); //外部キー
            $table->foreignId('tweet_id')->constrained()->comment('ツイートID'); //外部キー
    
            $table->unique(['user_id', 'tweet_id']); //複合インデックスを作成
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};
