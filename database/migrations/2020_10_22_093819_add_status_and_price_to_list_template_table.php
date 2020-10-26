<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndPriceToListTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_template', function (Blueprint $table) {
            $table->float('price')->nullable()->after('avatar');
            $table->tinyInteger('status')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_template', function (Blueprint $table) {
            $table->dropColumn(['price']);
            $table->dropColumn(['status']);
        });
    }
}
