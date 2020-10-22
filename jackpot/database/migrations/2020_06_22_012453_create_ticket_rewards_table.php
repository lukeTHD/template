<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('ticket_rewards', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBigInteger('ticket_id');
//            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
//            $table->unsignedBigInteger('game_reward_id');
//            $table->foreign('game_reward_id')->references('id')->on('game_rewards')->onDelete('cascade');
//            $table->softDeletes();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('ticket_rewards');
    }
}
