<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('uid')->nullable();
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('prize_id');
            $table->foreign('prize_id')->references('id')->on('games_config')->onDelete('cascade');
            $table->float('percent', 20, 0);
            $table->float('amount', 20, 0);
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
//        Schema::table('commissions', function (Blueprint $table) {
//            $table->dropForeign(['ticket_id']);
//            $table->dropForeign(['from_id']);
//            $table->dropForeign(['uid']);
//            $table->dropForeign(['prize_id']);
//        });

        Schema::dropIfExists('commissions');
    }
}
