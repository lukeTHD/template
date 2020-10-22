<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaultActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vault_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('game_code',255);
            $table->foreign('game_code')->references('code')->on('games')->onDelete('cascade');
            $table->unsignedBigInteger('vault_id');
            $table->foreign('vault_id')->references('id')->on('vaults')->onDelete('cascade');
            $table->float('value',20,0);
            $table->string('type');
            $table->text('reason');
            $table->text('note');
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
        Schema::dropIfExists('vault_activities');
    }
}
