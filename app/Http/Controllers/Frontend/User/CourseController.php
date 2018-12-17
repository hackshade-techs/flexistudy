<?php

namespace App\Http\Controllers\Frontend\User;

use Helper;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Completion;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Technology;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Access\Role\Role;
use App\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class CourseController extends Controller
{
    // user's first course to become an author
    public function becomAnAuthor(Request $request)
    {
        $categories = Category::get(['id', 'name']);
        $tags = Course::allTags();
        
        return view('frontend.author.course.new-author-create', compact('categories', 'tags'));
    }
    
    public function store(Request $request)
    {
 
        $this->validate($request, [
            'title' => 'required|max:50',
            'subtitle' => 'required|max:120',
            'category' => 'required',
            'slug' => 'required|unique:courses,slug'
        ]);
        
        $user = $request->user();
        $author_role = Role::where('name', 'Author')->first();
        
        $course = new Course();
        $course->title = $request->title;
        $course->subtitle = $request->subtitle;
        $course->slug = $request->slug;
        $course->price = 0;
        $course->description = $request->description;
        $course->category_id = $request->category;
        $course->user_id = $user->id;
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
        
        if( !$user->hasRole('Author') ){
            $user->roles()->sync([$author_role->id]);
        }
        
        return redirect()->route('frontend.author.course.edit', $course->slug);
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myCourses(Request $request)
    {
        //dd(Carbon::now()->startOfMonth());
        $courses = $request->user()->enrollments;
	    
	    foreach($courses as $course)
	    {
	        $course->image = Helper::coverImage($course);
	    }
	    
        return view('frontend.user.course.my-courses', compact('courses'));
    }
    
    public function myWishlist(Request $request)
    {
        $courses = $request->user()->bookmarkedCourses()->get();

	    foreach($courses as $course)
	    {
	        $course->image = Helper::coverImage($course);
	    }
        return view('frontend.user.course.my-wishlist', compact('courses'));
    }
    
    public function myPurchases(Request $request)
    {
        $purchases = Payment::where('user_id', $request->user()->id)->with('course', 'coupon')->paginate(10);
        
	    
	    foreach($purchases as $purchase)
	    {
	        $purchase->course->coverImage = Helper::coverImage($purchase->course);
	    }
	    //return response()->json($purchases, 200);
        return view('frontend.user.course.my-purchases', compact('purchases'));
    }
    
    
    public function bookmark(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if ($request->user()->hasBookmarked($course)) {
            return;
        }
        $request->user()->bookmarks()->create([
            'course_id' => $course->id
        ]);

        return response()->json(null, 200);
    }
    
    
    public function unBookmark(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if ($request->user()->hasBookmarked($course)){
            $request->user()->bookmarks()->where('course_id', $course->id)->delete();
        }
        return response()->json(null, 200);
    }
    
    public function getBookmarkStatus(Request $request, $course)
    {
        $course = Course::find($course);
        if($request->user()){
            $user_bookmarked = $request->user()->hasBookmarked($course); 
        } else {
            $user_bookmarked = false;
        }
        
        return response()->json($user_bookmarked, 200);
    }
    
    
    public function markAsComplete(Request $request, Lesson $lesson)
    {
        if(! $request->user()->hasCompleted($lesson)){
            $completion = $lesson->completions()->create([
                'user_id' => $request->user()->id        
            ]);
        } 
        
        return response()->json(null, 200);
        
    }
    
    public function markAsInComplete(Request $request, Lesson $lesson)
    {
        if($request->user()->hasCompleted($lesson)){
            $request->user()->completions->where('lesson_id', $lesson->id)->first()->delete();
        } 
        
        return response()->json(null, 200);
        
    }
    
}

