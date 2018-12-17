<?php

namespace App\Http\Controllers\Frontend\User;


use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptDetail;
use App\Models\QuizQuestion as Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    
    
    public function fetchQuestions($lesson)
    {
        $q = Quiz::with('answers')->where('lesson_id', $lesson)->get();
        
        return response()->json($q, 200);
    }
    
    
    public function saveAttempt(Request $request, $lesson)
    {
        $count = 0;
        
        foreach($request->questions as $q){
           if($q['question']['selectedAnswer']['correct'] == 1){
               $count++;
           } 
        }
        
        $attempt = auth()->user()->quizAttempts()->create([
            'lesson_id' => $lesson,
            'total_attempted' => count($request->questions),
            'total_correct' => $count
        ]);
        
        foreach($request->questions as $q){
            $correctAnswer = QuizAnswer::where('question_id', $q['question']['id'])->where('correct', 1)->first();
            
            $attempt->attemptDetails()->create([
                'question' => $q['question']['question'],    
                'chosen_answer' => $q['question']['selectedAnswer']['answer'],
                'correct_answer' => $correctAnswer ? $correctAnswer->answer : 'NA'
            ]);
        }
        
        return response()->json(null, 200);
        
    }
    
}
