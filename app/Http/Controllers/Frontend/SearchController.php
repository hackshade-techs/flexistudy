<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Auth;
use Helper;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Completion;
use App\Models\Category;
use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    public function getCourses(Request $request)
    {
    	
        $filters = [];
        $search_term = $request->search;
        $search_category = $request->category;
        $search_level = $request->level;
        //$search_language = $request->language;
        $search_price = $request->price;
        $sort_order = $request->sort_order;
        
        if(!is_null($request->tag)){
	    	$query = Course::withAnyTags($request->tag)->with('sections', 'author')->with('sections.lessons')->with('sections.lessons.content')->where('approved', true)->where('published', true);
        } else {
        	$query = Course::with('sections', 'author')->with('sections.lessons')->with('sections.lessons.content')->where('approved', true)->where('published', true);
        }
	    if(!is_null($search_term))
	    {
	        $query->where(function ($q) use ($search_term) {
	           $q->where('title', 'like', "%$search_term%")
	                ->orWhere('description', 'like', "%$search_term%")
	                ->orWhereHas('author', function($q) use ($search_term){
	                    $q->where('first_name', 'like', "%$search_term%")
	                    ->orWhere('last_name', 'like', "%$search_term%")
	                    ->orWhere('username', 'like', "%$search_term%");
	                });
	        });
	        
	    }
	    
	    // filter by level
	    if(!is_null($search_level))
	    {
	        $query->where(function ($q) use ($search_level) {
	           $q->where('level', '=', "$search_level") ;
	        });
	        $filters = array_add($filters, 'level', $search_level);

	    } 
	    
	    // filter by category
	    if(!is_null($search_category))
	    {
	        $query->whereHas('category', function ($q) use ($search_category) {
	           $q->where('slug', '=', $search_category) ;
	        });
	        $filters = array_add($filters, 'category', $search_category);
	    } 
	    
	    // filter by price
	    if(!is_null($search_price))
	    {
	        if($search_price=='free'){
	            $query->where(function ($q) use ($search_price) {
    	           $q->where('price', '=', 0) ;
    	        });
	        } else {
	            $query->where(function ($q) use ($search_price) {
    	           $q->where('price', '>', 0) ;
    	        });
	        }
	        
	        $filters = array_add($filters, 'price', $search_price);
	    }

        if(!is_null($sort_order))
        {
	            if( $sort_order == 'price_asc' ) { 
	                $query = $query->orderBy('price', 'asc'); 
	            } elseif( $sort_order == 'price_desc' ) { 
	                $query = $query->orderBy('price', 'desc'); 
	            } elseif( $sort_order == 'dte_recent_last' ) { 
	                $query = $query->orderBy('created_at', 'asc'); 
	            } elseif( $sort_order == 'dte_recent_first' ) { 
	                $query = $query->orderBy('created_at', 'desc'); 
	            } else { 
	                $query = $query->with(['averageReviewRatings' => function($q){
	                		$q->orderBy('average_rating', 'desc');
	                	}]);
	            }
	            
	            $courses = $query;
	            
	            $filters = array_add($filters, 'sort_order', $sort_order);

        }

		/*$query = $query->has('sections')->whereHas('sections.lessons', function($q){
			$q->where('preview', true)
				->whereHas('content', function($q){
					$q->where('content_type', '=', 'video');
				});
			});*/
		
		$courses = $query->hasContent()->paginate(9);
		

	    foreach($courses as $course)
	    {
	        $course->image = Helper::coverImage($course);
	    }
	    
	    $used_tags = DB::table('taggable_tags')
	    		->join('taggable_taggables', 'taggable_tags.tag_id', '=', 'taggable_taggables.tag_id')
	    		->join('courses', 'courses.id', '=', 'taggable_taggables.taggable_id')
	    		->groupBy('taggable_tags.normalized')
	    		->groupBy('taggable_tags.name')
	    		->orderBy('tag_count', 'DESC')
	    		->limit(20)
	    		->get(['taggable_tags.name', 'taggable_tags.normalized', DB::raw('count(taggable_tags.normalized) as tag_count')] );
	  
	    return view('frontend._course.index', compact('courses', 'search_term', 'filters', 'used_tags'));
    }
    
    
    
    public function autocompleteCourse(Request $request)
    {
    	$search_term = $request->search;
    	$courses = Course::where('published', true)
    		            ->where('title', 'LIKE', '%'.$search_term.'%')
    		            ->hasContent()
    		            ->select('id', 'title', 'slug')
    		            ->orderby('title', 'desc')->get();
    	//dd($courses);
    	return response()->json($courses);	
    }
    
    public function autocompleteAuthor(Request $request)
    {
    	$search_term = $request->search;
    	$authors = User::where('first_name', 'LIKE', '%'.$search_term.'%')
    					->orWhere('last_name', 'LIKE', '%'.$search_term.'%')
    					->orWhere('username', 'LIKE', '%'.$search_term.'%')
    		            ->active()
    		            ->whereHas('roles', function($q){
    		            	$q->where('name', 'Author');
    		            })
    		            //->select('id', 'username')
    		            ->orderby('username', 'desc')->get();

    	return response()->json($authors);	
    }
    
    
}