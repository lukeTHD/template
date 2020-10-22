<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameCodeAndGameRewardIdForeignKeyToLotteryActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lottery_activities', function (Blueprint $table) {
            //
            $table->foreign('game_code')->references('game_code')->on('games_config')->onDelete('cascade');
            $table->foreign('game_reward_id')->references('id')->on('games_config')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lottery_activities', function (Blueprint $table) {
            //
            $table->dropForeign(['game_reward_id']);
            $table->dropForeign(['game_code']);
        });
    }
}
