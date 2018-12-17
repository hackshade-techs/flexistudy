<?php

namespace App\Http\Controllers\Frontend\Payments;

use Session;
use Redirect;
use Cookie;
use Carbon\Carbon;
use Razorpay\Api\Api;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Input;
use App\Models\Payment as CoursePayment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RazorpayPaymentController extends Controller
{
    
    
    public function charge(Request $request)
    {
     
        $course = Course::find($request->course);
        
        $coupon = Coupon::where('code', $request->coupon)
            ->where(function($q) use ($course) {
                $q->where('course_id', $course->id)
                  ->orWhere('sitewide', true);
            })->first();
            

        if(!is_null($coupon)){
            $expected_amount = (float)($course->price - ($course->price * ($coupon->percent/100)));
    	    
    	    $expected_amount = number_format((int)$expected_amount ,2,'.','');
    	    $sent_amount = number_format((int)$request->amount,2,'.','');
    	    
            if($sent_amount != $expected_amount){
                return redirect(route('frontend.course.show', $course))->withFlashDanger(trans('alerts.frontend.general.wrong-price'));
            }
        } else {
            if($request->amount != $course->price){
                return redirect(route('frontend.course.show', $course))->withFlashDanger(trans('alerts.frontend.general.wrong-price'));
            }
        }
        
        $input = Input::all();
        
        //get API Configuration 
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                
                $response = $api->payment->fetch($input['razorpay_payment_id'])
                                ->capture(array('amount'=>$payment['amount'])); 
                
                // save to database
                $referee = User::where('affiliate_id', Cookie::get('tutorpro_affid'))->first();
                $organicPercent = config('settings.organicSalesPercentage')/100;
                $promoPercent = config('settings.promoSalesPercentage')/100;
                $affiliatePercent = config('settings.affiliateSalesPercentage')/100;
                
                $user = $request->user();
                $payment = new CoursePayment();
                
                $payment->course_id = $request->course;
                $payment->user_id = $request->user()->id;
                $payment->amount = $request->amount;
                
                $payment->payment_method = 'razorpay';
                
                if($coupon){
                    $payment->coupon_id = $coupon->id;
                }
                
                if(!is_null($referee)){
                    $payment->referred_by = $referee->id;
                    $payment->affiliate_earning = $request->amount * $affiliatePercent;
                    
                    if($coupon && $coupon->sitewide == false){
                        $payment->author_earning = ($request->amount - $payment->affiliate_earning) * $promoPercent;
                    } else{
                        $payment->author_earning = ($request->amount - $payment->affiliate_earning) * $organicPercent;
                    }
                } elseif($coupon && $coupon->sitewide == false){
                    $payment->author_earning = $request->amount * $promoPercent;
                } else{
                    $payment->author_earning = $request->amount * $organicPercent;
                }
                
                $payment->save();
                
                $course->students()->attach($request->user()->id);
            
                return redirect()->route('frontend.course.show', $course);
                
            } catch (\Exception $e) {
                \Session::put('error', $e->getMessage());
                //\Session::put('error', trans('strings.frontend.some-error-occured'));
                return redirect()->back();
            }
        }
        
    }
}
