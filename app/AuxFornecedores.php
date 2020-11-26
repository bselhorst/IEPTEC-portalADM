<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxFornecedores extends Model
{
    // use HasFactory;
    protected $fillable = ['nome', 'cnpj', 'descricao'];
}
