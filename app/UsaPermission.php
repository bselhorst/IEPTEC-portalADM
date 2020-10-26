<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsaPermission extends Model
{
    protected $fillable = ['user_id', 'folder_id'];
}
