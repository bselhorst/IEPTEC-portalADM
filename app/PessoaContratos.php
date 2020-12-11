<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaContratos extends Model
{
    protected $fillable = [
        'matricula',
        'termo_portaria',
        'carga_horaria',
        'salario',
        'renovacao',
        'data_renovacao',
        'data_nomeacao',
        'data_exoneracao',
    ];
}
