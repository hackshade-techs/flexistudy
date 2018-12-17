<?php

namespace App\Http\Controllers\Api;

use Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Access\User\User;

class UserController extends Controller
{
    
    
    public function __construct(){
        $this->content = array();
    }
    
    public function login(Request $request){
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            
            if($user->oauthToken){
                Auth::user()->oauthToken()->delete();
            }
            $this->content['token'] =  $user->createToken('App Token')->accessToken;
            $this->content['user'] = Auth::user();
            $status = 200;
        } else {
            $this->content['error'] = "Could not authenticate with these credentials";
            $status = 401;
        }
     return response()->json($this->content, $status);    
    }
    
    
    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::user()->token()->revoke();
            $this->content['message'] = 'Signed out';
            $status = 200;
        }

        return response()->json($this->content, $status);    
    }
    
    public function profile(){
        $user = Auth::user();
        $user->image = $user->picture;
        return response()->json($user, 200);
    }
    
    // fetch user's enrolled courses
    public function getLoggedInUserCourses($id)
    {
        $user = User::find($id);
        
        $user_courses = $user->enrollments;
        foreach($user_courses as $course){
	        $course->image = Helper::coverImage($course);
	        $course->author->image = $course->author->picture;
	        $course->created_at_human = $course->created_at->diffForHumans();
	        $course->price = Helper::getPrice($course);
	    }
	    
	    return response()->json($user_courses, 200);  
        
    }
    
}
