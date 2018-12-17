<?php

namespace App\Http\Controllers\Frontend\Payments;


use URL;
use Auth;
use Input;
use Cookie;
use Session;
use Redirect;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Models\Payment as CoursePayment;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PayPalPaymentController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {

        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
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
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($course->title) // name of the item or course here
            ->setCurrency(config('settings.currency_code'))
            ->setQuantity(1)
            ->setPrice($request->amount);
            
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency(config('settings.currency_code'))
            ->setTotal($request->amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Course purchase');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('frontend.courses.charge.paypal.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('frontend.courses.charge.paypal.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', trans('strings.frontend.connection-timeout'));
                return Redirect::route('frontend.course.show', $course); // check route
            } else {
                \Session::put('error', trans('strings.frontend.some-error-occured'));
                return Redirect::route('frontend.course.show', $course); // check route
            }
        }
        
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('course_id', $course->id);
        Session::put('amount', $request->amount);
        Session::put('coupon', $request->coupon);
        
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        
        \Session::put('error', trans('strings.frontend.some-error-occured'));
        return Redirect::route('frontend.course.show', $course); // check route
    }
    
    public function paymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        
        $course = Course::find(Session::get('course_id'));
        $amount = Session::get('amount');
        //dd($course);
        $coupon = Coupon::where('code', Session::get('coupon'))->where('course_id', $course->id)->first();
        $payment_id = Session::get('paypal_payment_id');
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('amount');
        Session::forget('coupon');
        Session::forget('course_id');
        
        if (empty($request->PayerID) || empty($request->token)) {
            \Session::put('error', trans('strings.frontend.payment-failed'));
            return Redirect::route('frontend.course.show', $course); // check url
        }
        
        $payment = Payment::get($payment_id, $this->_api_context);
        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') { 
            $referee = User::where('affiliate_id', Cookie::get('tutorpro_affid'))->first();
            $organicPercent = config('settings.organicSalesPercentage')/100;
            $promoPercent = config('settings.promoSalesPercentage')/100;
            $affiliatePercent = config('settings.affiliateSalesPercentage')/100;
            
            // payment succeeded, so save information to database
            $user = $request->user();
            $payment = new CoursePayment();
            
            $payment->course_id = $course->id;
            $payment->user_id = $request->user()->id;
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
            
            $payment->amount = $amount;
            $payment->payment_method = 'paypal';
            $payment->save();
            
            $course->students()->attach($request->user()->id);
            
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success', trans('strings.frontend.payment-processed'));
            return Redirect::route('frontend.course.show', $course);
        } else {
            \Session::put('error', trans('strings.frontend.payment-failed'));
            return Redirect::route('frontend.course.show', $course); // check route
        }
        
    }
    
}
