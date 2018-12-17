<?php

namespace App\Http\Controllers\Frontend\Author;

use DB;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FrontendController.
 */
class SectionController extends Controller
{
    public function getSections($course)
    {

        $sections = Section::with(['lessons' => function($q){
            $q->orderBy('sortOrder', 'ASC');
            $q->with('content');
            $q->with('quizQuestions');
            $q->with('quizQuestions.answers');
            $q->with('attachments');
        }])
        ->where('course_id', $course)
        ->orderBy('sortOrder', 'ASC')
        ->get();
        
        foreach($sections as $s){
            foreach($s->lessons as $l){
                if($l->content && $l->content->video_src == 'upload'){
                    $l->content_source = 'upload';
                } elseif ($l->content && $l->content->video_provider == 'youtube') { 
                    $l->content_source = 'youtube'; 
                } elseif ($l->content && $l->content->video_provider == 'vimeo') { 
                    $l->content_source = 'vimeo'; 
                } elseif ($l->content && $l->content->video_provider == 's3') { 
                    $l->content_source = 's3'; 
                } else {
                    $l->content_source = null; 
                }
                
                if($l->preview){
                     $l->preview = true;
                } else {
                     $l->preview = false;
                }
            }    
        }
        
        return response()->json($sections, 200);
    }

    
    /**
     * handle store method for new section
     */
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required|max:100'
        ]);
        
        $maxSort = DB::table('sections')->where('course_id', $request->course_id)->max('sortOrder');
        $section = new Section();
        $section->course_id = $request->course_id;
        $section->title = $request->title;
        $section->objective = $request->objective;
        $section->sortOrder = $maxSort+1;
        $section->save();
        
        return response()->json(['section' => $section], 200);
    }
    
    
    public function edit($id)
    {
        $section = Section::find($id);
        return response()->json($section, 200);
    }
    /**
     * handle update of a section. Takes the section id
     */
    public function update(Request $request, $id)
    {
        $section = Section::find($id);
        if(!$section){
            return response()->json(['message' => 'Section not found'], 404);
        }
        $section->title = $request->title;
        $section->objective = $request->objective;
        $section->save();
        
        return response()->json(['section' => $section], 200);
    }
    
    public function updateDraggable(Request $request)
    {
        $section = Section::find($request->data['id']);
        $section->sortOrder = $request->data['sortOrder'];
        $section->save();
        return response()->json($section, 200);
    }
    
    /**
     * handle delete of a section
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return response()->json(['message' => 'Section deleted'], 200);
    }
}
