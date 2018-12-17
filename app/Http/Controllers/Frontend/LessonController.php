<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App\Models\QuizAttempt;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\SectionTransformer;

class LessonController extends Controller
{
    public function show(Request $request, Course $course, Lesson $lesson)
    {
        $lesson = Lesson::with('attachments', 'content')->find($lesson->id);
        
        if($lesson->content && $lesson->content->content_type == 'video'){
            $lesson->content_type = 'video';
            $lesson->video_provider = $lesson->content->video_provider ? $lesson->content->video_provider:'mp4';
            $lesson->video_link = $lesson->content->video_path;
        } elseif ($lesson->content && $lesson->content->content_type == 'article') {
            $lesson->content_type = 'article';
            $lesson->article_content = $lesson->content->article_body;
        } elseif ($lesson->lesson_type == 'quiz') {
            $lesson->content_type = 'quiz';
        }else {
            $lesson->contents = null;
        }
        
        $sections = Section::with(['lessons' => function($q){
                $q->orderBy('sortOrder', 'ASC');
                $q->with('content');
                $q->with('attachments');
            }])
            ->where('course_id', $course->id)
            ->orderBy('sortOrder', 'ASC')
            ->get();
        
    
        foreach($sections as $s){
            foreach($s->lessons as $l){
                if($l->content && $l->content->content_type == 'video'){
                    $l->content_type = 'video';
                    $l->video_provider = $l->content->video_provider ? $l->content->video_provider:'mp4';
                    $l->video_link = $l->content->video_path;
                } elseif ($l->content && $l->content->content_type == 'article') {
                    $l->content_type = 'article';
                    $l->article_content = $l->content->article_body;
                } elseif ($l->lesson_type == 'quiz') {
                    $l->content_type = 'quiz';
                } else {
                    $l->contents = null;
                }
            }
        }
        
        // massage the objects to fetch next and previous lessons
        $sec_array = $sections->pluck('id');
        
        $lessons = Lesson::whereIn('section_id', $sec_array)
                    ->join('sections', 'lessons.section_id', '=', 'sections.id')  
                    ->orderBy('sections.sortOrder', 'ASC')
                    ->orderBy('lessons.sortOrder', 'ASC')
                    ->select('lessons.*')
                    ->get();
            
        $lessons = $lessons->each(function ($item, $key){
            $item->position = $key;
        });

        $current = $lessons->where('uid', $lesson->uid)->first();
        $next_lesson = $lessons->where('position', $current->position+1)->first(); 
        $previous_lesson = $lessons->where('position', $current->position-1)->first();
        
        
        
        $quiz_attempts = QuizAttempt::latest()->where('user_id', auth()->id())->where('lesson_id', $lesson->id)->get();
        
        foreach($quiz_attempts as $a){
            $a->percent = round( ($a->total_correct/$a->total_attempted)*100);
        }
  
        
        return view('frontend._lesson.show', compact('lesson', 'sections', 'attachments', 'course', 'next_lesson', 'previous_lesson', 'quiz_attempts'));
    }
}
