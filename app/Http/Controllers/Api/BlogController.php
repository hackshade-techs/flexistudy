<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    
    public function getPosts()
    {
        $posts = Blog::latest()->with('category')->where('type', 'article')->get();
        
        foreach($posts as $post){
            $post->created_at_human = $post->created_at->diffForHumans();
        }
        $postCategories = BlogCategory::whereHas('blogs', function($q){
            $q->where('published', true)
                ->where('type', 'article');
        })->get();
        
        return response()->json($posts, 200);
        
    }
    
    public function showPost($id)
    { 
        $post = Blog::with('category')->find($id);
        $post->created_at_human = $post->created_at->diffForHumans();
        return response()->json($post, 200);
    }
}
