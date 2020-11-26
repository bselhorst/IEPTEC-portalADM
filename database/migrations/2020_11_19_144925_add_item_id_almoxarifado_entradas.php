<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemIdAlmoxarifadoEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almoxarifado_entradas', function (Blueprint $table) {
            $table->foreignId('item_id')->nullable()->after('id');
            $table->foreign('item_id')->references('id')->on('almoxarifado_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('almoxarifado_entradas', function (Blueprint $table) {
            $table->dropForeign('almoxarifado_items_item_id_foreign');
            $table->dropColumn('item_id');
        });
    }
}
