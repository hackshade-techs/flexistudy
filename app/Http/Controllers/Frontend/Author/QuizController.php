<?php

namespace App\Http\Controllers\Frontend\Author;

use App\Models\Lesson;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    
    
    public function saveQuestion(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answers' => 'required',
        ]);
        
        $lesson = Lesson::find($request->lesson_id);
        
        $q = $lesson->quizQuestions()->create([
            'question' => $request->question    
        ]);
        
        foreach($request->answers as $answer){
            $q->answers()->create([
                'answer' => $answer['text'],
                'correct' => $answer['correct'],
                'explanation' => $answer['explanation']
            ]);
        }
        
        return response()->json(null, 200);

    }
    
    public function updateQuestion(Request $request, $question_id)
    {
        $q = QuizQuestion::find($question_id);
        
        $q->question = $request->question['question'];
        $q->save();
       
        foreach($q->answers as $answer){
            $answer->delete();
        }
        
        foreach($request->question['answers'] as $ans){
            $q->answers()->create([
                'answer' => $ans['answer'],
                'correct' => $ans['correct'],
                'explanation' => $ans['explanation']
            ]);
        }
        
        return response()->json(null, 200);
        
    }
    
    public function deleteQuestion($id)
    {
        $q = QuizQuestion::find($id)->delete();
        
        return response()->json(null, 200);
    }
    
    public function deleteAnswer($id)
    {
        
    }
    
}
