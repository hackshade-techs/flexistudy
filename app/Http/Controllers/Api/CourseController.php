<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Access\User\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use Helper;

class CourseController extends Controller
{
    
    
    public function __construct(){
        $this->content = array();
    }
    
    public function fetchAll()
    {
        $query = Course::with('sections', 'author')->with('sections.lessons')->with('sections.lessons.content')->where('approved', true)->where('published', true);
        
        $courses = $query->hasContent()->get();

	    foreach($courses as $course){
	        $course->image = Helper::coverImage($course);
	        $course->author->image = $course->author->picture;
	        $course->created_at_human = $course->created_at->diffForHumans();
	        $course->price = Helper::getPrice($course);
	    }
	    
        return response()->json($courses, 200);  
    }
    
    public function getCourseById($id)
    {
        $course = Course::with(['sections' => function($q){
			$q->orderBy('sortOrder', 'ASC');
			$q->with(['lessons' => function($q){
				$q->orderBy('sortOrder', 'ASC');
				$q->with('content');
			}]);
		}])->with('author')->find($id);
        
        $course->image = Helper::coverImage($course);
        $course->author->image = $course->author->picture;
        $course->created_at_human = $course->created_at->diffForHumans();
        $course->price = Helper::getPrice($course);
        
        foreach($course->sections as $section){
            foreach($section->lessons as $lesson){
                if($lesson->content && $lesson->content->content_type == 'video'){
                    $lesson->content_type = 'video';
                    $lesson->video_provider = $lesson->content->video_provider ? $lesson->content->video_provider:'mp4';
                    $lesson->video_link = $lesson->content->video_path;
                } elseif ($lesson->content && $lesson->content->content_type == 'article') {
                    $lesson->content_type = 'article';
                    $lesson->article_content = $lesson->content->article_body;
                } else {
                    $lesson->contents = null;
                }
            }
        }
        
        $sections = Section::where('course_id', $course->id)
            ->pluck('id');
            
        $preview_lessons = Lesson::whereIn('section_id', $sections)->where('preview', true)
        	->whereHas('content', function($q){
        		$q->where('content_type', 'video');	
        	})->get();

        foreach($preview_lessons as $l){
            $l->content_type = 'video';
            $l->video_provider = $l->content->video_provider ? $l->content->video_provider:'mp4';
            $l->video_link = $l->content->video_path;
        }
        
        $course->preview_lessons = $preview_lessons;
        
        return response()->json($course, 200);  
    }
    
    

    
}
