<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAlmoxarifadoItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almoxarifado_items', function (Blueprint $table) {
            $table->foreignId('unidade_id')->nullable()->after('descricao');
            $table->foreign('unidade_id')->references('id')->on('aux_unidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('almoxarifado_items', function (Blueprint $table) {
            $table->dropForeign('almoxarifado_items_unidade_id_foreign');
            $table->dropColumn('unidade_id');
        });
    }
}
