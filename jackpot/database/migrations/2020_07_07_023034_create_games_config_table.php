<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('game_code');
            $table->foreign('game_code')->references('code')->on('games')->onDelete('cascade');
            $table->string('type',20);
            $table->string('title')->nullable();
            $table->string('code',50);
            $table->foreign('code')->references('code')->on('game_setting_code')->onDelete('cascade');
            $table->float('percent',20,0)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('games_config');
    }
}
