<?php

namespace App\Http\Controllers\Frontend\Author;

use File;
use Storage;
use App\Models\Lesson;
use App\Models\Content;
use App\Jobs\UploadVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FrontendController.
 */
class ContentController extends Controller
{
    public function uploadVideo(Request $request)
    {
        
        $lesson = Lesson::find($request->id);
        
        if($lesson->content && $lesson->content->count()){
            $deleteVideo = $lesson->content->video_filename;
            
            $lesson->content->delete();

            if(config('settings.uploadLocation') == 'local' && Storage::disk('server')->exists('videos/'.$deleteVideo)){
                Storage::disk('server')->delete('videos/'.$deleteVideo);
            } elseif(config('settings.uploadLocation') == 's3' && Storage::disk('s3')->exists($deleteVideo)){
                Storage::disk('s3')->delete($deleteVideo);
            }
           
        }
        
        $originalFileName = $request->file('video')->getClientOriginalName();
        $ext = $request->file('video')->extension();

        $filename = str_random(3). '-' . substr(str_slug($originalFileName), 0, -3).'.'.$ext;
        
        $path = $request->file('video')->storeAs('uploads', $filename, 'tmpStorage');
        
        $this->dispatch(new UploadVideo(
            $filename
        ));
        
        $content = new Content();
        $content->lesson_id = $request->id;
        $content->content_type = 'video';
        $content->video_filename = $filename;
        $content->video_duration = $request->duration;
        if(config('settings.uploadLocation') == 's3'){
            $content->video_path = Storage::disk('s3')->url($filename);
        } else {
            $content->video_path = '/uploads/videos/'.$filename;
        }
        $content->video_src = 'upload';
        $content->video_storage = config('settings.uploadLocation');
        $content->save();
    }
    
    public function editEmbed($lesson_id)
    {
        $content = Content::where('lesson_id', $lesson_id)->first();
        return response()->json($content, 200);
    }
    
    
    public function embedVideo(Request $request)
    {
        $lesson = Lesson::find($request->id);
        $lesson->content()->create([
            'video_src' => 'embed',
            'content_type' => 'video',
            'video_provider' => $request->video_provider,
            'video_duration' => $request->duration,
            'video_path' => $request->videoLink
        ]);
        
        return response()->json(null, 200);
        
    }
    
    public function updateEmbedVideo(Request $request, $id)
    {
        
        $content = Content::where('lesson_id', $id)->first();
        $content->video_path = $request->videoLink;
        $content->video_duration = $request->duration;
        $content->save();
        
        return response()->json(null, 200);
    }
    
    public function createArticle(Request $request)
    {
        $content = new Content();
        $content->lesson_id = $request->lesson_id;
        $content->content_type = 'article';
        $content->article_body = $request->article_body;
        $content->save();
        return response()->json($content, 200);
    }
    
    public function edit($id)
    {
        $content = Content::find($id);
        return response()->json($content, 200);
    }
    
    public function updateArticle(Request $request, $id)
    {
        $content = Content::find($id);
        $content->article_body = $request->article_body;
        $content->save();
        return response()->json($content, 200);
    }
}
