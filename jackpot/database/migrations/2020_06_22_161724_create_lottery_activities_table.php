<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotteryActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lottery_id');
            $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('cascade');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->unsignedBigInteger('game_reward_id')->nullable();
            $table->float('value',20,0)->default(0);
            $table->string('game_code');
//            $table->float('share_new_percent')->nullable();
//            $table->float('share_company_percent')->nullable();
//            $table->float('share_up_percent')->nullable();
//            $table->float('share_level_2_percent')->nullable();
//            $table->float('share_new_value', 20)->nullable();
//            $table->float('share_company_value', 20)->nullable();
//            $table->float('share_up_value', 20)->nullable();
//            $table->float('share_level_2_value', 20)->nullable();
            $table->tinyInteger('is_win')->default(0);
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
        Schema::dropIfExists('lottery_activities');
    }
}
