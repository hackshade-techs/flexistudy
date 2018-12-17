<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';
    
    
    protected $fillable=['question_id', 'answer', 'correct', 'explanation'];
    
    
    public function question()
    {
        return $this->belongsTo(QUizQuestion::class, 'question_id');
    }

}
