<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuxEmpresasTerceirizados extends Model
{
    public $fillable = ['nome', 'descricao', 'cnpj'];
}
