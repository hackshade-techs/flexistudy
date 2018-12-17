<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable=['title', 'objective', 'course_id', 'sortOrder'];
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
