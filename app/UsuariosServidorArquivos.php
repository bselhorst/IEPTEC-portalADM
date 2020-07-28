<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosServidorArquivos extends Model
{
    protected $fillable = ['setor_id', 'tipo', 'colaborador', 'login', 'status'];
}
