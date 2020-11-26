<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmoxarifadoEntradas extends Model
{
    //use HasFactory;
    protected $fillable = ['item_id', 'fornecedor_id', 'quantidade', 'valor_unitario', 'valor_total'];
}
