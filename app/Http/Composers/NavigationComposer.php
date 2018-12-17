<?php

namespace App\Http\Composers;


use Auth;
use App\Models\Course;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\View\View;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
/**
 * Class NavigationComposer.
 */
class NavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        
        $view->with('menuPages', Blog::where('type', 'page')->where('display_main_menu', true)->orderBy('title', 'asc')->get());
        $view->with('footerPages', Blog::where('type', 'page')->where('display_footer', true)->orderBy('title', 'asc')->get());
        $view->with('menuBlog', Blog::where('type', 'article')->get());
        $view->with('categories', Category::with('courses')->get());
        $view->with('tags', Course::allTags());
       
    }
}
