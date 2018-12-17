<?php

namespace App\Http\Controllers\Frontend\Author;

use DB;
use File;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FrontendController.
 */
class LessonController extends Controller
{
    public function store(Request $request)
    {
        
        $maxSection = Section::where('course_id', $request->course_id)->orderBy('sortOrder', 'DESC')->first();
        
        $maxSort = DB::table('lessons')->where('section_id', $maxSection->id)->max('sortOrder');

        $lesson = new Lesson();
        $lesson->section_id = $maxSection->id;
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->lesson_type = $request->lesson_type;
        $lesson->uid = random_int(100, 20000) + random_int(99, 2000);
        $request->has('preview') ? $lesson->preview = true : $lesson->preview = false;
        $lesson->sortOrder = $maxSort+1;
        $lesson->save();
        
        return response()->json($lesson, 200);
    }
    
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        return response()->json($lesson, 200);
    }
    
    public function update(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->preview = $request->preview;
        $lesson->save();
        
        return response()->json($lesson, 200);
    }
    
    public function updateDraggable(Request $request)
    {
        $lesson = Lesson::find($request->data['id']);
        $lesson->sortOrder = $request->data['sortOrder'];
        $lesson->section_id = $request->data['section_id'];
        $lesson->save();
        return response()->json($lesson, 200);
    }
    
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        
        $lesson->delete();
        return response()->json(['message' => 'Section deleted'], 200);
    }
    
    
    
    /**************************************************************************/
    // Lesson attachments
    
    public function uploadAttachment(Request $request, $lesson)
    {
        $lesson = Lesson::find($lesson);
        
        // upload file resources
        if($request->hasFile('attachment')){
            $file_name = time().'_'.$request->file('attachment')->getClientOriginalName();
            $destination = public_path(). '/uploads/attachments';
            
            $request->file('attachment')->move($destination, $file_name);
            
            $attachment = $lesson->attach($destination.'/'.$file_name);
        }
        
        return redirect()->back();
        
    }
    
    public function deleteAttachment($lesson, $attachment)
    {
        $lesson = Lesson::find($lesson);
        $att= $lesson->attachment($attachment);
        
        $att->delete();
        
        if (File::exists('uploads/attachments/'.$att->filename)){
            File::delete('uploads/attachments/'.$att->filename);
        }

        return response()->json(null, 200);
        
    }
}
