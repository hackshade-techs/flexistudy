<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog as Post;
use App\Models\BlogCategory as Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
    public function index(Request $request)
    {
        if($request->filter=='pages'){
            $posts = Post::orderBy('slug', 'asc')->withoutGlobalScopes()->where('type', 'page')->get();
            $filter = 'pages';
        } elseif($request->filter=='posts'){
            $posts = Post::orderBy('slug', 'asc')->withoutGlobalScopes()->where('type', 'article')->get();
            $filter = 'posts';
        } else {
            $posts = Post::orderBy('slug', 'asc')->withoutGlobalScopes()->get();
            $filter = 'all';
        }
        
        return view('backend._post.index', compact('posts', 'filter'));
    }
    
    public function create()
    {
        $languages = [];
        
        foreach (array_keys(config('locale.languages')) as $lang){
            $languages = array_add($languages, $lang, trans('menus.language-picker.langs.'.$lang));
        }
        
        $postCategories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('backend._post.create', compact('postCategories', 'languages'));
    }
    
    public function edit($post, $locale)
    {
        $languages = [];
        
        foreach (array_keys(config('locale.languages')) as $lang){
            $languages = array_add($languages, $lang, trans('menus.language-picker.langs.'.$lang));
        }
        
        $post = Post::where('slug', $post)->where('lang', $locale)->withoutGlobalScopes()->first();
        
        $postCategories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('backend._post.edit', compact('post', 'postCategories', 'languages'));
    }
    
    public function update(Request $request, $post, $locale)
    {
        
        $post = Post::where('slug', $post)->where('lang', $locale)->withoutGlobalScopes()->first();
        if(config('demo.demo_mode') && $post->id < 21){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $this->validate($request, [
            'title' => 'required|unique:blogs,title,'.$post->id,
            //'slug'  => 'required|unique:blogs,slug,'.$post->id,
            'slug' => 'required|unique_with:blogs,lang,'.$post->id,
            'body'  => 'required',
            'lang'  => 'required',
            'type'  => 'required|in:article,page',
            'blog_category_id' => 'required'
        ]);
        
        $post->title = $request->title;
        $post->lang = $request->lang;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->type = $request->type;
        $post->display_main_menu = $request->display_main_menu ? true : false;
        $post->display_footer = $request->display_footer ? true : false;
        $post->featured_frontend = $request->featured_frontend ? true : false;
        $post->blog_category_id = $request->blog_category_id;
        $post->published = $request->published ? true : false;
        $post->save();
  
        foreach(Post::where('slug', $post->slug)->withoutGlobalScopes()->get() as $p){
            $post->featured_frontend ? $p->featured_frontend = true : $p->featured_frontend = false;
            $p->save();
        }
       
        return redirect()->route('admin.pages.index');
    }
    
    public function store(Request $request)
    {
 
        $this->validate($request, [
            'title' => 'required|unique:blogs,title',
            'slug' => 'required|unique_with:blogs,lang',
            'body'  => 'required',
            'lang'  => 'required',
            'type'  => 'required',
            'blog_category_id' => 'required'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->lang = $request->lang;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->type = $request->type;
        $post->display_main_menu = $request->display_main_menu ? true : false;
        $post->display_footer = $request->display_footer ? true : false;
        $post->featured_frontend = $request->featured_frontend ? true : false;
        $post->blog_category_id = $request->blog_category_id;
        $post->published = $request->published ? true : false;
        $post->save();
        
        foreach(Post::where('slug', $post->slug)->withoutGlobalScopes()->get() as $p){
            $post->featured_frontend ? $p->featured_frontend = true : $p->featured_frontend = false;
            $p->save();
        }
        
        return redirect()->route('admin.pages.index');
    }
    
    public function destroy($post, $locale)
    {
        
        $post = Post::where('slug', $post)->where('lang', $locale)->withoutGlobalScopes()->first();
        
        if(config('demo.demo_mode') && $post->id < 21){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $post->delete();
        return redirect()->back();
    }
    
    
}
