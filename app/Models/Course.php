<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'price',
        'description',
        'hours'
    ];

    public function courseInstances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseInstance::class);
    }
}
