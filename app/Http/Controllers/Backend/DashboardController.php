<?php

namespace App\Http\Controllers\Backend;

use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Withdrawal;
use Carbon\Carbon;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $lifetime_sales_amount = Payment::all()->sum('amount');
        $lifetime_sales_count = Payment::all()->count();
        $lifetime_withdrawal_amount = Withdrawal::where('status', 'processed')->sum('amount');
        $lifetime_withdrawal_count = Withdrawal::where('status', 'processed')->count();
        
        $pending_withdrawal_count = Withdrawal::whereNotIn('status', ['processed'])->count();
        
        $now = Carbon::now();
        
        $sales_this_month_amount = Payment::whereBetween('created_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])->sum('amount');
        $sales_this_month_count = Payment::whereBetween('created_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])->count();
        
        $withdrawals_this_month_amount = Withdrawal::where('status', 'processed')->whereBetween('updated_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])->sum('amount');
        $withdrawals_this_month_count = Withdrawal::where('status', 'processed')->whereBetween('updated_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])->count();
        
        return view('backend.dashboard', compact('lifetime_sales_amount', 'lifetime_sales_count', 'sales_this_month_amount', 'sales_this_month_count', 'lifetime_withdrawal_amount', 'lifetime_withdrawal_count', 'pending_withdrawal_count', 'withdrawals_this_month_amount', 'withdrawals_this_month_count'));
    }
}
