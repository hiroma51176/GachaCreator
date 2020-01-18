<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGachasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gachas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('gacha_name');
            $table->string('gacha_description')->nullable();
            $table->integer('jackpot_rate');
            $table->integer('hit_rate');
            $table->integer('miss_rate');
            $table->integer('play_price')->nullable();
            $table->integer('total_play_count')->nullable()->default(0);
            $table->string('image_path')->nullable();
            $table->integer('ceiling')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gachas');
    }
}
