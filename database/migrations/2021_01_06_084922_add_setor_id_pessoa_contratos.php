<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetorIdPessoaContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoa_contratos', function (Blueprint $table) {
            $table->foreignId('setor_id')->nullable()->after('pessoa_id');
            $table->foreign('setor_id')->references('id')->on('aux_setores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoa_contratos', function (Blueprint $table) {
            $table->dropForeign('pessoa_contratos_setor_id_foreign');
            $table->dropColumn('setor_id');
        });
    }
}
