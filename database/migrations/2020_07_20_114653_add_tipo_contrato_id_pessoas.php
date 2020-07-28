<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoContratoIdPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->foreignId('tipo_contrato_id')->nullable()->after('setor_id');
            $table->foreign('tipo_contrato_id')->references('id')->on('aux_tipos_contratos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->dropForeign('pessoas_tipo_contrato_id_foreign');
            $table->dropColumn('tipo_contrato_id');
        });
    }
}
