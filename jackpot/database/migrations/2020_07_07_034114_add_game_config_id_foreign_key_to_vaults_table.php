<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameConfigIdForeignKeyToVaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaults', function (Blueprint $table) {
            $table->foreign('game_config_id')->references('id')->on('games_config')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vaults', function (Blueprint $table) {
            $table->dropForeign(['game_config_id']);
        });
    }
}
