<?php

namespace App\Http\Controllers\Frontend\Author;

use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index(Course $course, Request $request)
    {
        if($course->user_id != $request->user()->id){
            return redirect(route('frontend.author.course.index'))->withFlashDanger(trans('auth.general_error'));
        };
        $course = Course::where('id', $course->id)->with('coupons')->first();
        $prices = collect(explode(',',config('settings.pricelist')));
        //dd($prices);
        return view('frontend.author.course.coupon.coupon', compact('course', 'prices'));
    }
    
    public function getCoupons($course)
    {

        $coupons = Coupon::where('course_id', $course)->paginate(10);
        foreach($coupons as $c){
            $c->active ? $c->active=true : $c->active=false;  
            $c->finalPrice = round($c->course->price - (($c->percent/100)*$c->course->price), 1);
            $c->link = route('frontend.course.show', $c->course) . '?COUPON='.$c->code;
            $c->totalUsed = $c->payments->count(); 
            $c->exhausted = $c->payments->count() >= $c->quantity ? true:false;
        };
        
        if (isset($request->per_page)) {
            $per_page = $request->per_page;
        } else {
            $per_page = 10;
        }
        
        return [
            'pagination' => [
                'total' => $coupons->total(),
                'per_page' => $per_page,
                'current_page' => $coupons->currentPage(),
                'last_page' => $coupons->lastPage(),
                'next_page_url' => $coupons->nextPageUrl(),
                'prev_page_url' => $coupons->previousPageUrl(),
                'from' => $coupons->firstItem(),
                'to' => $coupons->lastItem(),
            ],
            'data' => $coupons->items()
        ];

        return response()->json($coupons, 200);
    }
    
    public function activate(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $request->status==true ? $coupon->active=false : $coupon->active=true; 
        $coupon->save();
        return response()->json($coupon, 200);
    }
    
    public function store(Request $request)
    {
        $course_id = $request->course_id;
        
        $this->validate($request, [
            'code' => 'required|alpha_dash|unique:coupons,code,NULL,id,course_id,' . $course_id,
            'percent' => 'required',
            'quantity' => 'required'
        ]);
        
        $coupon = new Coupon();
        $coupon->course_id = $request->course_id;
        $coupon->code = strToUpper($request->code);
        $coupon->percent = $request->percent;
        $coupon->quantity = $request->quantity;
        if($request->expires){
            $coupon->expires = date("Y-m-d",strtotime($request->expires));
        }
        $coupon->active = true;
        $coupon->save();
        
        return response()->json(null, 200);
        
    }
}
