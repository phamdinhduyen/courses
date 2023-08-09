<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
  
}