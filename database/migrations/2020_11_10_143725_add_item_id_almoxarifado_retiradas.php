<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemIdAlmoxarifadoRetiradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almoxarifado_retiradas', function (Blueprint $table) {
            $table->foreignID('item_id')->nullable()->after('id');
            $table->foreign('item_id')->references('id')->on('almoxarifado_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('almoxarifado_retiradas', function (Blueprint $table) {
            $table->dropForeign('almoxarifado_retiradas_item_id_foreign');
            $table->dropColumn('item_id');
        });
    }
}
