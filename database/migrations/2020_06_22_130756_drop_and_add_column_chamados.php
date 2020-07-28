<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAndAddColumnChamados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropColumn('titulo');
            $table->foreignId('categoria_id')->nullable()->after('id');
            $table->foreign('categoria_id')->references('id')->on('aux_categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->string('titulo')->after('solicitante');
            $table->dropForeign('chamados_categoria_id_foreign');
            $table->dropColumn('categoria_id');
        });
    }
}
