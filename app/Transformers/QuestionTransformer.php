<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Question;

class QuestionTransformer extends TransformerAbstract
{
 
    public function transform(Question $question)
    {
        return [
            'id' => $question->id,
            'slug' => $question->slug,
            'course' => $question->course_id,
            'course_slug' => $question->course->slug,
            'title' => $question->title,
            'body' => $question->body,
            'created_at_human' => $question->created_at->diffForHumans(),
            'updated_at_human' => $question->created_at != $question->updated_at ? $question->updated_at->diffForHumans() : null,
            'user' => $question->user,
            'answers' => $question->answers,
            'answered' => $question->hasBeenAnswered()
            
        ];
    }
}