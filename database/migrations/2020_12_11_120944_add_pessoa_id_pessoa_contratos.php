<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPessoaIdPessoaContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoa_contratos', function (Blueprint $table) {
            $table->foreignId('pessoa_id')->nullable()->after('id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');
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
            $table->dropForeign('pessoa_contratos_pessoa_id_foreign');
            $table->dropColumn('pessoa_id');
        });
    }
}
