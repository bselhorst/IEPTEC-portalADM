<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaContratos extends Model
{
    protected $fillable = [
        'tipo_contrato_id',
        'empresa_id',
        'setor_id',
        'pessoa_id',
        'funcao_id',
        'matricula',
        'termo_portaria',
        'carga_horaria',
        'salario',
        'renovacao',
        'data_nova_exoneracao',
        'data_renovacao',
        'data_nomeacao',
        'data_exoneracao',
        'status'
    ];
}
