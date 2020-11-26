<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmoxarifadoItems extends Model
{
    // use HasFactory;
    protected $fillable = ['codigo', 'descricao', 'unidade_id', 'estoque_minimo', 'saldo'];
}
