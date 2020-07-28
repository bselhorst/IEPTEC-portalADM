<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $fillable = ['setor_id', 'tipo_contrato_id', 'funcao_id', 'nome', 'origem', 'telefone', 'email'];
}
