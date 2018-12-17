<?php

namespace App\Http\Controllers\Frontend\User;

use DB;
use Auth;
use Helper;
use App\Models\Review;
use App\Models\Course;
use App\Models\CourseReviewRating;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ReviewCreateRequest;
use App\Transformers\ReviewTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


class ReviewController extends Controller
{
    
    public function store(ReviewCreateRequest $request)
    {
        $course = Course::find($request->course_id);
		
		$review = $course->reviews()->create([
			'rating' => $request->rating,
			'user_id' => $request->user()->id,
			'comment' => $request->comment
		]);
		
		if($review){
		    $ar = CourseReviewRating::where('course_id', $course->id)->first();
		    if($ar){
		        $ar->average_rating = $course->reviews->avg('rating');
		        $ar->save();
		    } else {
		        $course->averageReviewRatings()->create([
		            'average_rating' => $course->reviews->avg('rating')           
	            ]);
		    }
		}
		return response()->json($review, 200);

    }
	
	public function getReviews($course_id)
    {

        $reviews = Review::latest()->where('course_id', $course_id)->paginate(10);
        return fractal()
            ->collection($reviews)
            ->transformWith(new ReviewTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($reviews))
            ->toArray();
    }    
}