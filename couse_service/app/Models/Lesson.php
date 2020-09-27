<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id', 'name', 'video'
    ];

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
}
