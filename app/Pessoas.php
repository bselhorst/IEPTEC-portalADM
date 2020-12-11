<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $fillable = [
        'nome',
        'filiacao1',
        'filiacao2',
        'rg',
        'orgaoExp',
        'cpf',
        'sexo',
        'dataNascimento',
        'rua',
        'numero',
        'apt',
        'bairro',
        'municipio',
        'complemento',
        'cep',
        'telefone',
        'celular',
        'email',
        'nomeDeEmergencia',
        'numeroEmergencia',
    ];
}
