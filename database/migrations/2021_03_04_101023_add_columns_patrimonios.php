<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPatrimonios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            //bem_id
            $table->foreignId('bem_id')->nullable()->after('id');
            $table->foreign('bem_id')->references('id')->on('patrimonio_bems');

            //situacao_id
            $table->foreignId('situacao_id')->nullable()->after('bem_id');
            $table->foreign('situacao_id')->references('id')->on('aux_situacao_bems');

            //setor_origem_id
            $table->foreignId('setor_origem_id')->nullable()->after('numero_pat_ieptec');
            $table->foreign('setor_origem_id')->references('id')->on('aux_setores');

            //setor_destino_id
            $table->foreignId('setor_destino_id')->nullable()->after('locado');
            $table->foreign('setor_destino_id')->references('id')->on('aux_setores');

            //local específico
            $table->string('local_especifico')->nullable()->after('setor_destino_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            //bem_id
            $table->dropForeign('patrimonios_bem_id_foreign');
            $table->dropColumn('bem_id');

            //situacao_id
            $table->dropForeign('patrimonios_situacao_id_foreign');
            $table->dropColumn('situacao_id');

            //setor_origem_id
            $table->dropForeign('patrimonios_setor_origem_id_foreign');
            $table->dropColumn('setor_origem_id');

            //setor_destino_id
            $table->dropForeign('patrimonios_setor_destino_id_foreign');
            $table->dropColumn('setor_destino_id');

            //local específico
            $table->dropColumn('local_especifico');
        });
    }
}
