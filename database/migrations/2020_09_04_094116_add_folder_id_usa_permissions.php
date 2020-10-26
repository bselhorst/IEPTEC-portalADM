<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFolderIdUsaPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usa_permissions', function (Blueprint $table) {
            $table->foreignId('folder_id')->nullable()->after('user_id');
            $table->foreign('folder_id')->references('id')->on('aux_usa_folders')->onDelete('cascade');            
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
            $table->dropForeign('usa_permissions_folder_id_foreign');
            $table->dropColumn('folder_id');
        });
    }
}
