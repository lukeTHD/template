<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('credit_id');
            $table->foreign('credit_id')->references('id')->on('credits')->onDelete('cascade');
            $table->float('value',20,0)->default(0);
            $table->string('type');
            $table->text('reason');
            $table->float('old_value',20,0);
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
        Schema::dropIfExists('credit_activities');
    }
}
