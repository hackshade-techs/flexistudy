<?php

namespace App\Http\Controllers\Frontend\Payments;

use Session;
use Cookie;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\Access\User\User;
use App\Models\Payment as CoursePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripePaymentController extends Controller
{

    public function applyCoupon(Request $request)
    {
        $code = strToUpper($request->code);
        
        $course_id = $request->course;
        $coupon = Coupon::where('code', $code)
            ->where(function($q) use ($course_id) {
                $q->where('course_id', $course_id)
                  ->orWhere('sitewide', true);
            })->first();
            
        $course = Course::find($request->course);
        
        if($coupon && $coupon->active){
            $status = $this->verifyCoupon($coupon);
            if($status == 'expired' || $status == 'exhausted'){
                $coupon_status = $status;
                $price = $course->price;
            } else {
                $coupon_status = 'valid';
                $price = $course->price - (($coupon->percent/100) * $course->price);
            }
        } else {
            $coupon_status = 'invalid';
            $price = $course->price;
        }
        
        return response()->json([
           'status' => $coupon_status,
           'price' => $price,
           'code' => $code
        ], 200);

    }
    
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
        
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $token = $request->token;
        
        $charge = \Stripe\Charge::create(array(
          "amount" => $request->amount * 100,
          "currency" => config('settings.currency_code'),
          "description" => "Purchase by >> " . $request->user()->email . " <<",
          "source" => $token,
        ));
        
        if ($charge) {
            
            $referee = User::where('affiliate_id', Cookie::get('tutorpro_affid'))->first();
            $organicPercent = config('settings.organicSalesPercentage')/100;
            $promoPercent = config('settings.promoSalesPercentage')/100;
            $affiliatePercent = config('settings.affiliateSalesPercentage')/100;
            
            $user = $request->user();
            $payment = new CoursePayment();
            
            $payment->course_id = $request->course;
            $payment->user_id = $request->user()->id;
            $payment->amount = $request->amount;
            
            $payment->payment_method = 'stripe';
            
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
            
            \Session::put('success', trans('strings.frontend.payment-processed'));
            return redirect()->route('frontend.course.show', $course);
        } else {
            \Session::put('error', trans('strings.frontend.some-error-occured'));
           return redirect()->back();
        }
    }
    
    protected function verifyCoupon($coupon)
    {
        $quantity = $coupon->quantity;
        $totalUsed = $coupon->payments->count(); 
        
        $now = Carbon::now();
        if( !is_null($coupon->expires) && $coupon->expires < $now ){
            return 'expired';
        }
        if( $totalUsed >= $quantity){
            return 'exhausted';
        }

        return 'valid';
    }
    
    
}
