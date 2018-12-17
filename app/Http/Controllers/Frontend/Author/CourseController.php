<?php

namespace App\Http\Controllers\Frontend\Author;

use Auth;
use Storage;
use Helper;
use App\Models\Access\User\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Category;
use App\Models\Approval;
use Illuminate\Http\Request;
use App\Notifications\CourseSubmitted;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class CourseController extends Controller
{
    protected $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }
    
    public function index()
    {
        $courses = Course::latest()->where('user_id', Auth::id())->get();

        return view('frontend.author.course.index', compact('courses'));
    }
    
    public function create()
    {
        $categories = Category::get(['id', 'name']);
        $tags = Course::allTags();
        
        return view('frontend.author.course.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:50',
            'subtitle' => 'required|max:120',
            'category' => 'required',
            'slug' => 'required|unique:courses,slug'
        ]);
        
        $course = new Course();
        $course->title = $request->title;
        $course->subtitle = $request->subtitle;
        $course->slug = $request->slug;
        $course->price = 0;
        $course->description = $request->description;
        $course->category_id = $request->category;
        $course->user_id = Auth::id();
        $course->save();
        
        $course->tag(explode(',', $request->tags));
      
        $section = $course->sections()->create([
            'title' => 'Start here',
            'objective' => 'Short course objective',
            'sortOrder' => 1
        ]);
        
        $section->lessons()->create([
            'title' => 'Introduction',
            'uid' => random_int(100, 20000) + random_int(99, 2000),
            'sortOrder' => 1
        ]);
        
        return redirect()->route('frontend.author.course.edit', $course->slug);
    }

    public function edit(Request $request, Course $course)
    {
        
        if($course->user_id != $request->user()->id){
            return redirect(route('frontend.author.course.index'))->withFlashDanger(trans('auth.general_error'));
        }; 
        $tags = Course::allTags();

        $course->default_image = Helper::coverImage($course);
        
        return view('frontend.author.course.edit', compact('course', 'tags'));
    }
    
    public function getCourse($id)
    {
        $course = Course::find($id);
        return response()->json($course, 200);
    }
    
    public function curriculum(Request $request, Course $course)
    {
        //if(!$request->user()->can('update', $course)){
        if($course->user_id != $request->user()->id){
            return redirect(route('frontend.author.course.index'))->withFlashDanger(trans('auth.general_error'));
        };
        
        return view('frontend.author.course.curriculum', compact('course'));
    }
    
    public function update(Request $request, $id)
    {
        if(config('demo.demo_mode') && $id < 11){
            return back();
        };
        $course = Course::find($id);
        
        $this->validate($request, [
            'title' => 'required|max:50',
            'subtitle' => 'required|max:120',
            'slug' => 'required|unique:courses,slug,'.$course->id
        ]);
        
        $course->title = $request->title;
        $course->subtitle = $request->subtitle;
        $course->slug = $request->slug;
        $course->description = $request->description;
        $course->level = $request->level;
        $course->language = $request->language;
        $course->save();
        
        $course->retag(explode(',', $request->tags));
        
        //return redirect()->route('frontend.author.course.edit', $course->slug);
        
        return response()->json($course, 200);
    }
    
    public function submitForReview(Request $request, $id)
    {
        if(config('demo.demo_mode') && $id < 11){
            return back()->withFlashDanger('Not allowed in Demo mode');
        };
        $course = Course::find($id);
        if($course->published){
            $course->published = false;
        } else {
            $course->published = true;
        }
        $course->save();
        
        // notify the admin of a new submission
        $admins = User::whereHas('roles', function($q){
           $q->where('name', 'Administrator'); 
        })->get();
        
        foreach($admins as $admin){
            $admin->notify(new CourseSubmitted($course));
        }
        
        return redirect()->back();
    }
    
    public function adminReview(Course $course)
    {
        $approvals = Approval::latest()->where('course_id', $course->id)->get();
        return view('frontend.author.course.admin-approval', compact('approvals', 'course'));
    }
    
    public function updatePrice(Request $request, $id)
    {
        $course = Course::find($id);

        $course->price = $request->price;
        $course->save();
        
        return response()->json($course, 200);
    }

    public function updateImage(Request $request, $id)
    {
        $course = Course::find($id);
        $oldImage = $course->image; // delete the old image from the file system after new one is uploaded
        $processedImage = $this->imageManager->make($request->file('files')->getPathName())
            ->fit(1920, 1080, function ($c) {
                $c->aspectRatio();
            })
            ->encode('png')
            ->save(public_path('uploads/images/course/' . $filename = uniqid(true) . '.png'));
        
        $course->image = $filename;
        $course->save();
        
        if(!is_null($oldImage)){
            if(Storage::disk('server')->exists('images/course/'.$oldImage)){
                Storage::disk('server')->delete('images/course/'.$oldImage);
            }
        }
        $path = '/uploads/images/course/'.$course->image; 
        //return response($path, 200);
        
        return response([
            'data' => [
                'path' => $path,
            ]
        ], 200);
    }

    public function destroy(Course $course)
    {
        if($course->author->id == auth()->id()){
            $course->delete();
        }
        
        return redirect('/author/courses');
    }
    
}
