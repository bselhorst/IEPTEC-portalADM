<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    //
    protected $fillable = ['evento', 'inicio', 'fim'];
}
