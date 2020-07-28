<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignMarca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aux_modelos', function (Blueprint $table) {
            $table->foreignId('marca_id')->nullable()->after('id');
            $table->foreign('marca_id')->references('id')->on('aux_marcas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aux_modelos', function (Blueprint $table) {
            $table->dropForeign('aux_modelos_marca_id_foreign');
            $table->dropColumn('marca_id');
        });
    }
}
