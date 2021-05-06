<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPessoasContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoa_contratos', function (Blueprint $table) {
            $table->integer('tipo_contrato_id')->nullable()->after('pessoa_id');
            $table->integer('empresa_id')->nullable()->after('tipo_contrato_id');
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
            $table->dropColumn('tipo_contrato_id');
            $table->dropColumn('empresa_id');
        });
    }
}
