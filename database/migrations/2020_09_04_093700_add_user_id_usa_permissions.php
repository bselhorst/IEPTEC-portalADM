<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdUsaPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usa_permissions', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('usuarios_servidor_arquivos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usa_permissions', function (Blueprint $table) {
            $table->dropForeign('usa_permissions_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
