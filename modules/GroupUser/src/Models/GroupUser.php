<?php

namespace Modules\GroupUser\src\Models;

use Modules\Courses\src\Models\Course;
use Illuminate\Database\Eloquent\Model;


class GroupUser extends Model
{
      protected $table = "group_user";
    protected $fillable = [
        'name',
        'id'
    ];

 
}