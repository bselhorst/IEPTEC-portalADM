<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_contratos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->nullable();
            $table->string('termo_portaria')->nullable();
            $table->double('carga_horaria')->nullable();
            $table->decimal('salario', 8, 2)->nullable();
            $table->string('renovacao')->nullable();
            $table->date('data_renovacao')->nullable();
            $table->date('data_nomeacao')->nullable();
            $table->date('data_exoneracao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa_contratos');
    }
}
