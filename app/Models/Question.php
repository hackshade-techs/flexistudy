<?php

namespace App\Models;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['title', 'user_id', 'course_id', 'slug', 'body' ];
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function hasBeenAnswered()
    {
        return (bool)$this->answers->where('marked_as_answer', true)->where('question_id', $this->id)->count();
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function follows()
    {
        return $this->hasMany(QuestionFollow::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
