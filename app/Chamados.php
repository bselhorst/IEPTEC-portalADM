<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    protected $fillable = ['categoria_id', 'descricao', 'user_id', 'setor_id', 'solicitante', 'finished_at'];
}
