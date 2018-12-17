<?php

namespace App\Models;


use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    
    protected $fillable=['user_id', 'lesson_id', 'total_attempted','total_correct'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function quiz()
    {
        return $this->belongsTo(Lesson::class);
    }
    
    public function attemptDetails()
    {
        return $this->hasMany(QuizAttemptDetail::class, 'attempt_id');
    }
    
}
