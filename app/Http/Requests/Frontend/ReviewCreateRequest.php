<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
//use App\Http\Requests\Request;


class ReviewCreateRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'rating' => 'required|numeric',
            'course_id' => 'unique:reviews,course_id,NULL,id,user_id,' . Auth::id()
        ];
    }
    
    public function messages()
    {
        return [
            'rating.required' => 'Please provide a star rating',
            'course_id.unique'  => 'You have already reviewed this course',
        ];
    }
}
