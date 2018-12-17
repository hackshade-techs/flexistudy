<?php

namespace App\Http\Controllers\Frontend;

use Helper;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show(Request $request, User $user)
    {
        $courses = Course::where('user_id', $user->id)->where('published', true)->where('approved', true);
        $courses = $courses->hasContent()->get();
        //$courses = $user->authored_courses->where('published', true)->where('approved', true);
        foreach($courses as $course){
            $course->image = Helper::coverImage($course);
        }
        return view('frontend.user.public.profile', compact('user', 'courses'));
    }
    
}
