<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use Helper;
use App\Models\Section;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Lesson;
use App\Models\Completion;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementComment;
use App\Http\Controllers\Controller;
use App\Transformers\AnnouncementCommentTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


/**
 * Class AccountController.
 */
class AnnouncementController extends Controller
{

    public function index(Request $request, Course $course)
    {
        $sections = Section::where('course_id', $course->id)
            ->orderBy('sortOrder', 'ASC')
            ->pluck('id');
        $first_lesson = Lesson::whereIn('section_id', $sections)->orderBy('created_at', 'asc')->first();
		$lessons = Lesson::whereIn('section_id', $sections)->pluck('id');
		$completion = Completion::latest()->whereIn('lesson_id', $lessons)->where('user_id', Auth::id())->first();
		
		$last_watched = $completion ? Lesson::find($completion->lesson_id) : null;
		
        return view('frontend._course.enrolled.announcements', compact('course', 'first_lesson', 'last_watched'));
    }
    
    public function getComments(Request $request, $announcement_id)
    {
        $comments = AnnouncementComment::where('announcement_id', $announcement_id)->with('user')->latest()->paginate(2);
        
        foreach($comments as $comment){
            $comment->user->image = $comment->user->picture;
            $comment->user->can_edit = $comment->user->id == $request->user()->id ? true : false;
            $comment->created_at_human = $comment->created_at->diffForHumans();
        }
        
        return fractal()
            ->collection($comments)
            ->transformWith(new AnnouncementCommentTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($comments))
            ->toArray();
    }
    
    public function getComment(Request $request, $id)
    {
        $comment = AnnouncementComment::find($id);
        return response()->json($comment, 200);
    }
    
    public function storeComment(Request $request, $announcement_id)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $announcement = Announcement::find($announcement_id);
        $comment = $announcement->comments()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);
        
        return response()->json($comment, 200);
    }
    
    public function updateComment(Request $request, $id)
    {
        $comment = AnnouncementComment::find($id);
        $comment->body = $request->body;
        $comment->save();
        return response()->json($comment, 200);
    }
    
    public function deleteComment(Request $request, $id)
    {
        $comment = AnnouncementComment::find($id)->delete();
        return response()->json(null, 200);
        
    }
    
    
}

