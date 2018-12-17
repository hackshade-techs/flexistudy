<?php

namespace App\Http\Controllers\Frontend\User;

use DB;
use Auth;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    
    public function myRevenue(Request $request)
    {
        
        $withdrawals = Withdrawal::latest()->where('user_id', $request->user()->id)->paginate(10);
        $affiliate_earnings = Payment::with('user', 'course')->where('referred_by', $request->user()->id)->paginate(10);
        
        if(Auth::user()->hasRole('Author')){
            return redirect()->route('frontend.author.revenue.index');
        } else {
            return view('frontend.user.revenue.index', compact('affiliate_earnings', 'withdrawals')); 
        }
    }
    
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
}
