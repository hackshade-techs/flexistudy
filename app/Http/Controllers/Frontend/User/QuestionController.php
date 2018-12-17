<?php

namespace App\Http\Controllers\Frontend\User;

use DB;
use Auth;
use Helper;
use App\Models\Answer;
use App\Models\Section;
use App\Models\Course;
use App\Models\Question;
use App\Models\Lesson;
use App\Models\Completion;
use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Notifications\AnswerNotification;    
use App\Http\Controllers\Controller;
use App\Transformers\AnswerTransformer;
use App\Transformers\QuestionTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


class QuestionController extends Controller
{
    // Questions
    public function index(Request $request, Course $course)
    {
        $sections = Section::where('course_id', $course->id)
            ->orderBy('sortOrder', 'ASC')
            ->pluck('id');
        $first_lesson = Lesson::whereIn('section_id', $sections)->orderBy('created_at', 'asc')->first();
		$lessons = Lesson::whereIn('section_id', $sections)->pluck('id');
		$completion = Completion::latest()->whereIn('lesson_id', $lessons)->where('user_id', Auth::id())->first();
		
		$last_watched = $completion ? Lesson::find($completion->lesson_id) : null;
		
        return view('frontend._course.enrolled.questions', compact('course', 'first_lesson', 'last_watched'));
    }
    
    public function show(Course $course, Question $question)
    {
        $sections = Section::where('course_id', $course->id)
            ->orderBy('sortOrder', 'ASC')
            ->pluck('id');
        $first_lesson = Lesson::whereIn('section_id', $sections)->orderBy('created_at', 'asc')->first();
		$lessons = Lesson::whereIn('section_id', $sections)->pluck('id');
		$completion = Completion::latest()->whereIn('lesson_id', $lessons)->where('user_id', Auth::id())->first();
		
		$last_watched = $completion ? Lesson::find($completion->lesson_id) : null;
        return view('frontend._course.enrolled.question-detail', compact('course', 'question', 'first_lesson', 'last_watched'));
    }
    
    public function getQuestions(Request $request, $course)
    {
        $questions = Question::where('course_id', $course)->with('answers', 'user')->latest()->paginate(10);
        
        foreach($questions as $question){
            $question->user->image = $question->user->picture;
            $question->user->can_edit = $question->user->id == $request->user()->id ? true : false;
            $question->created_at_human = $question->created_at->diffForHumans();
        }
        
        return fractal()
            ->collection($questions)
            ->transformWith(new QuestionTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($questions))
            ->toArray();
    }
    
    public function getQuestion(Request $request, $id)
    {
        $question = Question::find($id);
        $question->author_image = $question->user->picture;
        $question->author_name = $question->user->full_name;
        $question->created_at_human = $question->created_at->diffForHumans();
        return response()->json($question, 200);
    }
    
    public function storeQuestion(Request $request, $course)
    {
        $course = Course::find($course);
        
        $question = $course->questions()->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user()->id,
            'course_id' => $course->id,
            'slug' => mt_rand(10,925000) + mt_rand(10,192)
        ]);
        
        return response()->json($question, 200);
    }
    
    public function updateQuestion(Request $request, $id)
    {
        $question = Question::find($id);
        $question->title = $request->title;
        $question->body = $request->body;
        $question->save();
        
        return response()->json($question, 200);
    }
    
    public function deleteQuestion($id)
    {
        $question = Question::find($id)->delete();
        return response()->json(null, 200);
    }
    
    // following questions
    public function follow(Request $request, $question_id)
    {
        $question = Question::find($question_id);
        if ($request->user()->hasFollowed($question)) {
            return;
        }
        $request->user()->questionFollows()->create([
            'question_id' => $question->id
        ]);

        return response()->json(null, 200);
    }
    
    
    public function unfollow(Request $request, $question_id)
    {
        $question = Question::find($question_id);
        if ($request->user()->hasFollowed($question)){
            $request->user()->questionFollows()->where('question_id', $question->id)->delete();
        }
        return response()->json(null, 200);
    }
    
    public function getFollowStatus(Request $request, $question)
    {
        $question = Question::find($question);
        if($request->user()){
            $user_followed = $request->user()->hasFollowed($question); 
        } else {
            $user_followed = false;
        }
        
        return response()->json($user_followed, 200);
    }
    
    
    
    
    // answers
    
    public function getAnswers(Request $request, $question_id)
    {
        $answers = Answer::where('question_id', $question_id)->with('user')->orderBy('marked_as_answer', 'desc')->orderBy('created_at', 'asc')->paginate(10);
        
        foreach($answers as $answer){
            $answer->user->image = $answer->user->picture;
            $answer->user->can_edit = $answer->user->id == $request->user()->id ? true : false;
            $answer->created_at_human = $answer->created_at->diffForHumans();
        }
        
        return fractal()
            ->collection($answers)
            ->transformWith(new AnswerTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($answers))
            ->toArray();
    }
    
    public function getAnswer(Request $request, $id)
    {
        $answer = Answer::find($id);
        return response()->json($answer, 200);
    }
    
    public function storeAnswer(Request $request, $question_id)
    {
        $question = Question::find($question_id);
        $answer = $question->answers()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);
        
        // get all users who are following the question and the author and send them notifications
        $userArr = $question->follows->pluck('user_id');
        $followers = User::whereIn('id', $userArr);
        $users = DB::table('users')->where('id', $question->user_id)->union($followers)->get();
        
        $recipients = User::whereIn('id', $users->pluck('id'))->get();
        
        foreach($recipients as $user){
            $user->notify(new AnswerNotification($answer, $question));
        }
        
        return response()->json($question, 200);
    }
    
    public function updateAnswer(Request $request, $id)
    {
        $question = Answer::find($id);
        $question->body = $request->body;
        $question->save();
        return response()->json($question, 200);
    }
    
    public function deleteAnswer(Request $request, $id)
    {
        $question = Answer::find($id)->delete();
        return response()->json(null, 200);
        
    }
    
    
    // mark answers as helpful
    public function markAsHelpful(Request $request, $answer_id)
    {
        $answer = Answer::find($answer_id);
        if ($request->user()->hasMarked($answer)) {
            return;
        }
        $request->user()->markedAnswers()->create([
            'answer_id' => $answer->id
        ]);

        return response()->json(null, 200);
    }
    
    
    public function unmarkAsHelpful(Request $request, $answer_id)
    {
        $answer = Answer::find($answer_id);
        if ($request->user()->hasMarked($answer)){
            $request->user()->markedAnswers()->where('answer_id', $answer->id)->delete();
        }
        return response()->json(null, 200);
    }
    
    public function getMarkStatus(Request $request, $answer)
    {
        $answer = Answer::find($answer);
        $answer_marks = $answer->marks;
        if($request->user()){
            $user_marked = $request->user()->hasMarked($answer); 
        } else {
            $user_marked = false;
        }
        
        return response()->json(['user_marked' => $user_marked, 'marks' => $answer_marks], 200);
    }
    
    public function markAsAnswer(Request $request, $answer)
    {
        $answer = Answer::find($answer);
        
        $bestAnswers = Answer::where('marked_as_answer', true)->where('question_id', $answer->question_id)->get();
        
        // only the person who asked the question can mark an answer
        if(Auth::check() && Auth::id() == $answer->question->user_id){
            
            // set all other answers to unmarked
            foreach($bestAnswers as $b){
                $b->marked_as_answer = false;
                $b->save();
            }
            
            $answer->marked_as_answer = true;
            $answer->save();

            return response()->json(null, 200);
        }
        
    }
    
}

