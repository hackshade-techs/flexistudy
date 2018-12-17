<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable=['title', 'body'];
    
    
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    
    public function comments()
    {
        return $this->hasMany(AnnouncementComment::class);
    }
}
