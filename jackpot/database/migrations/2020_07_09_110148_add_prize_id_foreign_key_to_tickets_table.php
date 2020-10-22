<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrizeIdForeignKeyToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
            $table->foreign('prize_id')->references('id')->on('games_config')->onDelete('cascade');
            $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['lottery_id']);
            $table->dropForeign(['prize_id']);
        });
    }
}
