<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmoxarifadoRetiradas extends Model
{
    // use HasFactory;
    protected $fillable = ['item_id', 'codigo', 'quantidade', 'solicitante', 'usuario'];
}
