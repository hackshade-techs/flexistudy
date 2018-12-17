<?php

namespace App\Http\Controllers\Frontend\Author;

use DB;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    // request withdrawal
    public function requestWithdrawal(Request $request)
    {
        $user_balance = $request->user()->account_balance();
        
        $this->validate($request, [
            'amount' => 'bail|required|numeric|min:'.config('settings.minimumPayoutAmount').'|max:'.$user_balance,
            'paypal_email' => 'required|email'
        ]);
        
        $request->user()->withdrawals()->create([
            'amount' => $request->amount,
            'paypal_email' => $request->paypal_email,
            'status' => 'submitted'
        ]);
        
        return redirect()->back();
        
    }
    
    
    public function index(Request $request)
    {
        
        $withdrawals = Withdrawal::latest()->where('user_id', $request->user()->id)->paginate(10);
        
        $user = $request->user();
        $user_courses = Course::where('user_id', $user->id)->pluck('id');
        $all_user_earnings = Payment::with('user', 'coupon', 'course')->whereIn('course_id', $user_courses)->latest()->paginate(10);
        
        $affiliate_earnings = Payment::with('user', 'course')->where('referred_by', $user->id)->paginate(10);
        
        $coupon_purchases = Payment::whereNotNull('coupon_id')->pluck('coupon_id');
        $sitewide_coupons_used = Coupon::where('sitewide', true)->whereIn('id', $coupon_purchases)->pluck('id')->toArray();
        
        foreach($all_user_earnings as $e){
            if(!is_null($e->referred_by)){
                $e->channel = trans('strings.frontend.affiliate');
            } elseif( !is_null($e->coupon_id) && !in_array($e->coupon_id, $sitewide_coupons_used)){
               $e->channel = trans('strings.frontend.your-promotion'); 
            } else {
                $e->channel = trans('strings.frontend.organic-sales');
            }
        }
        
        return view('frontend.author.revenue.index', compact('user', 'affiliate_earnings', 'all_user_earnings', 'withdrawals'));
    }
    
    // api route
    public function fetchAllEarning(Request $request)
    {
        
        $organicPercent = config('settings.organicSalesPercentage')/100;
        $promoPercent = config('settings.promoSalesPercentage')/100;
        $user = User::find($request->user);
        $user_courses = Course::where('user_id', $user->id)->pluck('id');
        $all_user_earnings = DB::table('payments')
            ->select(DB::raw('DATE(created_at) as name, sum( CASE WHEN coupon_id is null THEN ' . $organicPercent . ' *amount ELSE ' . $promoPercent . ' *amount END) as data'))
            ->whereIn('course_id', $user_courses)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at', 'asc')
            ->get();
        $coupon_earnings = DB::table('payments')
            ->select(DB::raw('DATE(created_at) as name, sum('. $promoPercent .'*amount) as data'))
            ->whereIn('course_id', $user_courses)
            ->whereNotNull('coupon_id')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at', 'asc')
            ->get();
        $organic_earnings = DB::table('payments')
            ->select(DB::raw('DATE(created_at) as name, sum('. $organicPercent .'*amount) as data'))
            ->whereIn('course_id', $user_courses)
            ->whereNull('coupon_id')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at', 'asc')
            ->get();
        
        $arr = [];
        $arr['name'] = json_decode($all_user_earnings->pluck('name'));
        $arr['data'] = json_decode($all_user_earnings->pluck('data'));
        
        $arr_promo = [];
        $arr_promo['name'] = json_decode($coupon_earnings->pluck('name'));
        $arr_promo['data'] = json_decode($coupon_earnings->pluck('data'));
        
        $arr_organic = [];
        $arr_organic['name'] = json_decode($organic_earnings->pluck('name'));
        $arr_organic['data'] = json_decode($organic_earnings->pluck('data'));
        
        
        return response()->json(['sales' => $arr, 'promo'=> $arr_promo, 'organic' => $arr_organic], 200, [], JSON_NUMERIC_CHECK);
        
    }
    
    
    
    
    
    
}
