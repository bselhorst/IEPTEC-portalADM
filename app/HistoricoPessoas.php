<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoPessoas extends Model
{
    protected $fillable = ['usuario', 'acao', 'descricao'];
}
