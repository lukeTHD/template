<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('booking_id');
            // Foreign key for booking in another migration file
            $table->string('type');
            $table->text('picked');
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->string('status');
            $table->tinyInteger('is_divide_money')->default(0);
            $table->tinyInteger('is_add_vault')->default(0);
            $table->float('price',20,0);
            $table->unsignedBigInteger('prize_id')->nullable();
            $table->float('prize_value',20,0)->nullable();
            $table->unsignedBigInteger('lottery_id')->nullable();
            // is seen congratulations
            // 1: đã xem
            // 2: vé mới tạo mặc định là 2 => vé chưa có kết quả
            // 0: nếu vé trúng update thành 0 để show ra user dashboard
            $table->tinyInteger('is_seen_congratulation')->default(2)->nullable();
            $table->dateTime('picked_at')->useCurrent();
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
        Schema::dropIfExists('tickets');
    }
}
