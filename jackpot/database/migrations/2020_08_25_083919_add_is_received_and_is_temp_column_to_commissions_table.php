<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsReceivedAndIsTempColumnToCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commissions', function (Blueprint $table) {
            //
            $table->tinyInteger('is_received')->default(0)->after('currency'); // 0 =  chua nhan tien , 1 = nhan tien roi
            $table->tinyInteger('is_temp')->default(0)->after('currency');; // 0 = tam thoi, 1 = da nhan tien
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commissions', function (Blueprint $table) {
            //
            $table->dropColumn(['is_received']);
            $table->dropColumn(['is_temp']);
        });
    }
}
