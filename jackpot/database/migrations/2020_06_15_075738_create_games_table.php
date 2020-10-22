<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('avatar');
            $table->integer('number_pick');
            $table->integer('number_max');
            $table->string('code', 255)->unique();
            $table->text('description');
            $table->string('algorithm', 255);
            $table->float('price',20,0);
            $table->tinyInteger('status');
            $table->unsignedBigInteger('created_id');
            $table->time('start_time', 0);
            $table->time('end_time', 0);
            $table->time('roll_time', 0);
            $table->time('appear_time', 0);
            $table->integer('minimum_ticket')->default(1);
            $table->integer('ticket_limit')->nullable();
            $table->foreign('created_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_id')->nullable();
            $table->foreign('updated_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('games');
    }
}
