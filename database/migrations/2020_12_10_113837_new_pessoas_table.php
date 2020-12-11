<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewPessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('filiacao1')->nullable();
            $table->string('filiacao2')->nullable();
            $table->string('rg')->nullable();
            $table->string('orgaoExp')->nullable();
            $table->string('cpf')->nullable();
            $table->string('sexo')->nullable();
            $table->date('dataNascimento')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('apt')->nullable();
            $table->string('bairro')->nullable();
            $table->string('municipio')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('nomeDeEmergencia')->nullable();
            $table->string('numeroEmergencia')->nullable();
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
        Schema::dropIfExists('pessoas');
    }
}
