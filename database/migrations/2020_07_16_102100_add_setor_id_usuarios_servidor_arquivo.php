<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetorIdUsuariosServidorArquivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_servidor_arquivos', function (Blueprint $table) {
            $table->foreignId('setor_id')->nullable()->after('id');
            $table->foreign('setor_id')->references('id')->on('aux_setores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_servidor_arquivos', function (Blueprint $table) {
            $table->dropForeign('usuarios_servidor_arquivo_setor_id_foreign');
            $table->dropColumn('setor_id');
        });
    }
}
