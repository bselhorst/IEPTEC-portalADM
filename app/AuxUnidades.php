<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxUnidades extends Model
{
    //use HasFactory;
    protected $fillable = ['unidade', 'descricao'];
}
