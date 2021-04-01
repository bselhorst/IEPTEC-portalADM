<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatrimonioBem extends Model
{
    protected $fillable = ['descricao', 'marca', 'modelo', 'cor'];
}
