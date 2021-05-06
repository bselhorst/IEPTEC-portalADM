<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoPessoaContratos extends Model
{
    protected $fillable = ['usuario', 'acao', 'descricao'];
}
