<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{

    protected $fillable = ['name', 'description','price'];

    public function CourseStudent(): HasMany
    {
        return $this->hasMany(CourseStudent::class);
    }

}
