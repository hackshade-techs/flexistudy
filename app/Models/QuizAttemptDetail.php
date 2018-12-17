<?php

namespace App\Models;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class QuizAttemptDetail extends Model
{
    protected $fillable=['attempt_id', 'question','chosen_answer', 'correct_answer'];
    
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'attempt_id');
    }
}
