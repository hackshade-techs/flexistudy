<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Models\BlogCategory as Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {
        $blog_categories = Category::with('blogs')->get();
        return view('backend._blogcategory.index', compact('blog_categories'));
    }
    
    public function edit(Category $category)
    {

        return view('backend._blogcategory.edit', compact('category'));
    }
    
    
    public function update(Request $request, Category $category)
    {
        if(config('demo.demo_mode') && $category->id < 5){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $this->validate($request, [
            'name' => 'required|unique:blog_categories,name,'.$category->id
        ]);
        $category->name = $request->name;
        $category->save();
        return redirect()->back();
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:blog_categories,name'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();
        return redirect()->back();
    }
    
    public function destroy(Category $category)
    {
        if(config('demo.demo_mode') && $category->id < 5){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $category->delete();
        return redirect()->back();
    }
    
    
}
