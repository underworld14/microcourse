<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'certificate', 'thumbnail', 'type', 'status',
        'price', 'level', 'description', 'mentor_id'
    ];

    public function mentor()
    {
        return $this->belongsTo('App\Models\Mentor');
    }

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapters')->orderBy('id', 'ASC');
    }

    public function images()
    {
        return $this->hasMany('App\Models\CourseImage')->orderBy('id', 'DESC');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
}
