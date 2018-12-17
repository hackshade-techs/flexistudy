<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Answer;

class AnswerTransformer extends TransformerAbstract
{
 
    public function transform(Answer $answer)
    {
        return [
            'id' => $answer->id,
            'question' => $answer->question_id,
            'body' => $answer->body,
            'created_at_human' => $answer->created_at->diffForHumans(),
            'updated_at_human' => $answer->created_at != $answer->updated_at ? $answer->updated_at->diffForHumans() : null,
            'user' => $answer->user,
            'marks' => $answer->marks,
            'marked_as_answer' => $answer->marked_as_answer
            
        ];
    }
}