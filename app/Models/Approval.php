<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable=['course_id', 'decision', 'comment'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
