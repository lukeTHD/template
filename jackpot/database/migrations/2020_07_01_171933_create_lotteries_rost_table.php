<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotteriesRostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotteries_rost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lottery_id');
            $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('cascade');
            $table->string('value');
            $table->time('appear_time',0);
            $table->integer('sort');
            $table->softDeletes();
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
        Schema::dropIfExists('lotteries_rost');
    }
}
