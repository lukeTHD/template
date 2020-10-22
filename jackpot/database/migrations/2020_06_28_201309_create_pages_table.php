<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_id');
            $table->foreign('created_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_id')->nullable();
            $table->foreign('updated_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('background');
            $table->string('title',510);
            $table->text('description');
            $table->text('content');
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
        Schema::dropIfExists('pages');
    }
}
