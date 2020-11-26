<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsuarioAlmoxarifadoRetiradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almoxarifado_retiradas', function (Blueprint $table) {
            $table->text('usuario')->nullable()->after('solicitante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('almoxarifado_retiradas', function (Blueprint $table) {
            $table->dropColumn('usuario');
        });
    }
}
