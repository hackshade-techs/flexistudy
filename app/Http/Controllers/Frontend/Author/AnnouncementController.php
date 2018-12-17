<?php

namespace App\Http\Controllers\Frontend\Author;

use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Notifications\NewAnnouncement;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{

    public function index(Course $course, Request $request)
    {
        //if(!$request->user()->can('update', $course)){
        if($course->user_id != $request->user()->id){
            return redirect(route('frontend.author.course.index'))->withFlashDanger(trans('auth.general_error'));
        };
        $announcements = $course->announcements;
        return view('frontend.author.course.announcement.index', compact('announcements', 'course'));
    }
    
    public function create(Request $request, Course $course)
    {
        if($course->user_id != $request->user()->id){
            return redirect(route('frontend.author.course.index'))->withFlashDanger(trans('auth.general_error'));
        };
        $courses = Course::where('user_id', $request->user()->id)->where('published', true)->where('approved', true)->orderBy('title')->get();
        return view('frontend.author.course.announcement.create', compact('courses', 'course'));
    }
    
    public function store(Request $request, Course $course)
    {
        
        if($course->user_id != $request->user()->id){
            return redirect(route('frontend.author.course.index'))->withFlashDanger(trans('auth.general_error'));
        };
        
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required',
        ]);
        
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->save();
        
        $courses = explode(',', $request->courses);
        
        $announcement->courses()->attach($courses);
       
       
        $courses = Course::whereIn('id', explode(',', $request->courses))->with('students')->get();
        
        foreach($courses as $course){
            foreach($course->students as $student){
                $student->notify(new NewAnnouncement($announcement, $course));
            }
        }
        
        return redirect()->route('frontend.author.announcements.index', $course);
        
    }
    
    
}
