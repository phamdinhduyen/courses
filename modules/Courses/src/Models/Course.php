<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'teacher_id',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'supports',
        'status',
        'detail',
        'thumbnail'
    ];

    public function categories(){
       return $this->belongsToMany(Category::class, 'categories_courses');
    }
  
}