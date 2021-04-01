<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    protected $fillable = ["bem_id", "situacao_id", "numero_pat_see", "numero_pat_interno", "numero_pat_ieptec", "setor_origem_id", "locado", "setor_destino_id", "local_especifico"];
}
