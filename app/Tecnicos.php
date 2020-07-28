<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnicos extends Model
{
    protected $fillable = ['user_id'];
    
    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
