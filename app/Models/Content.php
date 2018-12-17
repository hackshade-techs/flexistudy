<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'lesson_id', 
        'content_type', 
        'video_filename', 
        'video_path', 
        'video_storage', 
        'video_src', 
        'article_body',
        'video_provider',
        'video_duration'
    ];
    
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
