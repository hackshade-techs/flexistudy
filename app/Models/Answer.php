<?php

namespace App\Models;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $fillable=['user_id', 'question_id', 'body', 'marked_as_answer'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function marks()
    {
        return $this->hasMany(HelpfulAnswer::class);
    }
    
    
}
