<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFornecedorIdAlmoxarifadoEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almoxarifado_entradas', function (Blueprint $table) {
            $table->foreignId('fornecedor_id')->nullable()->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('aux_fornecedores');
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
            $table->dropForeign('almoxarifado_entradas_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
}
