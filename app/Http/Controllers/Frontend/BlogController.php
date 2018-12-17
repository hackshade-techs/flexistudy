<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    
    public function showPage($page)
    {
        $page = Blog::where('slug', $page)->where('type', 'page')->first();
        $pages = Blog::latest()->where('type', 'page')->where('id', '<>', $page->id)->get();
        return view('frontend._blog.show_page', compact('page', 'pages'));  
    }
    
    public function getPosts()
    {
        $posts = Blog::latest()->where('type', 'article')->paginate(6);

        $postCategories = BlogCategory::whereHas('blogs', function($q){
            $q->where('published', true)
                ->where('type', 'article');
        })->get();
        return view('frontend._blog.index', compact('posts', 'postCategories'));
    }
    
    public function getPostsByCategory(BlogCategory $category)
    {
        $posts = Blog::latest()->where('published', true)->where('type', 'article')->where('blog_category_id', $category->id)->paginate(10);

        $postCategories = BlogCategory::whereHas('blogs', function($q){
            $q->where('published', true)
                ->where('type', 'article');
        })->get();
        return view('frontend._blog.index', compact('posts', 'postCategories'));
    }
    
    public function showPost($slug)
    { 
        $blog = Blog::where('slug', $slug)->first();
        $related_posts = Blog::where('blog_category_id', $blog->blog_category_id)->where('id', '!=', $blog->id)->where('published', true)->get();
        return view('frontend._blog.show_post', compact('blog', 'related_posts')); 
    }
}
