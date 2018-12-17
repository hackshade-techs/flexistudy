<?php

namespace App\Http\Controllers\Backend;

use App\Models\Course;
use App\Models\Approval;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Transformers\CourseTransformer;
use App\Notifications\CourseReviewed;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Http\Requests\Backend\Access\Course\ManageCourseRequest;


class AdminCourseController extends Controller
{
    // index
    public function index(Request $request)
    {
        $filter = $request->filter;
        return view('backend._course.index', compact('filter'));
    }
    
    // fetch
    public function fetch(Request $request)
    {
        if($request->filter == 'approved'){
            $courses = Course::where('approved', true)->with('author', 'category')->get();
        } elseif($request->filter == 'pending_approval') {
            $courses = Course::where('published', true)->where('approved', false)->with('author', 'category')->get();
        } elseif($request->filter == 'unpublished') {
            $courses = Course::where('published', false)->where('approved', true)->with('author', 'category')->get();
        } elseif($request->filter == 'draft') {
            $courses = Course::where('published', false)->where('approved', false)->with('author', 'category')->get();
        }else {
            $courses = Course::with('author', 'category')->get();
        }
        
        //$courses = Course::latest()->with('author', 'category');
        return Datatables::of($courses)
            ->addColumn('published', function ($course) {
                return $course->published ? trans('strings.backend.true') : trans('strings.backend.false');
            })
            ->addColumn('approved', function ($course) {
                return $course->approved ? trans('strings.backend.true') : trans('strings.backend.false');
            })
            ->addColumn('action', function ($course) {
                if($course->published){
                    if($course->canBeDeleted()){
                        return '<a href="'.route('admin.courses.review', $course->slug).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> '. trans('labels.backend.courses.review') .'</a>
                            
                            <a href="'.route('admin.courses.destroy', $course->slug).'"
                                 data-method="delete"
                                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
                    ;
                    } else {
                        return '<a href="'.route('admin.courses.review', $course->slug).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> '. trans('labels.backend.courses.review') .'</a>';
                    }
                } else {
                    return '';
                }
                
            })
            ->make(true);
    }
    
    // approve
    public function review(Request $request, Course $course)
    {
        $approvals = Approval::latest()->where('course_id', $course->id)->get();
        
        $courseHasContent = Course::where('id', $course->id)->hasContent()->count();
        
        return view('backend._course.review', compact('course', 'approvals', 'courseHasContent'));
    }
    
    // show
    public function statusUpdate(Request $request, Course $course)
    {
        if(config('demo.demo_mode') && $course->id < 11){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        
        $this->validate($request, [
            'comment' => 'required',
            'decision' => 'required|in:approved,disapproved'
        ]);
        $course->approvals()->create([
            'comment' => $request->comment,
            'decision' => $request->decision
        ]);
        
        if($request->decision == 'approved'){
            $course->published = true;
            $course->approved = true;
        } else {
            $course->published = false;
            $course->approved = false;
        }
        $course->save();
        
            
        $course->author->notify(new CourseReviewed($course));
        
        
        return redirect()->route('admin.courses.index');
    }
    
    
    public function featured()
    {
        return view('backend._course.featured');
    }
    
    public function fetchAllCourses()
    {
        $courses = Course::whereHas('category', function($q){
            $q->orderBy('name');
        })
        ->where('featured', false)
        ->where(['approved'=> true, 'published' => true])
        ->HasContent()
        ->paginate(10);
        
        return fractal()
            ->collection($courses)
            ->transformWith(new CourseTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($courses))
            ->toArray();
    }
    
    public function fetchFeatured(Request $request)
    {
        $courses = Course::whereHas('category', function($q){
            $q->orderBy('name');
        })
        ->where('featured', true)
        ->paginate(10);
        
        return fractal()
            ->collection($courses)
            ->transformWith(new CourseTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($courses))
            ->toArray();
    }
    
    public function updateFeatured(Request $request)
    {
        if(config('demo.demo_mode')){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $non_featured_courses = Course::whereNotIn('id', $request->course_ids)->get();
        $featured_courses = Course::whereIn('id', $request->course_ids)->get();
        
        foreach($non_featured_courses as $course){
            $course->featured = false;
            $course->save();
        }
        
        foreach($featured_courses as $course){
            $course->featured = true;
            $course->save();
        }
        
        return response()->json(null, 200);
        
    }
    
    public function destroy(Course $course)
    {
        
        $course->delete();
        
        return back();
        
    }
    
    
}
