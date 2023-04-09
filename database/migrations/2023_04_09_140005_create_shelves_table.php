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
        Schema::create('shelves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->timestamp('buy_date');// 購入日
            $table->string('buy_address');// 購入場所
            $table->string('name');// 品名
            $table->integer('price');// 単価
            $table->integer('num');// 購入数量
            $table->string('memory');// 思い出
            $table->timestamps();
            $table->tinyInteger('is_delete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shelves');
    }
};
