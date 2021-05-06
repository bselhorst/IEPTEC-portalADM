<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFuncaoIdPessoasContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoa_contratos', function (Blueprint $table) {
            $table->integer("funcao_id")->nullable()->after('setor_id');
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
            $table->dropColumn('funcao_id');
        });
    }
}
