<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::where('sitewide', true)->orderBy('active', 'DESC')->get();
        foreach($coupons as $coupon){
            $coupon->redeemed = Payment::where('coupon_id', $coupon->id)->count();
        }
        return view('backend._coupon.index', compact('coupons'));
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'code' => 'required|alpha_dash|unique:coupons,code',
            'percent' => 'required|numeric|max:100',
            'quantity' => 'required|numeric|min:1',
            'expires' => 'required|date'
        ]);
        
        $coupon = new Coupon();
        $coupon->code = strToUpper($request->code);
        $coupon->percent = $request->percent;
        $coupon->quantity = $request->quantity;
        $coupon->expires = date("Y-m-d",strtotime($request->expires));
        $coupon->active = false;
        $coupon->sitewide = true;
        $coupon->save();
        
        return redirect()->back();
    }
    public function activate($id)
    {
        if(config('demo.demo_mode')){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $coupon = Coupon::find($id);
        $now = Carbon::now();
        
        if($now > $coupon->expires){
            return redirect()->back()->withFlashDanger(trans('strings.backend.cannot-activate-expired'));
        } 
        
        $used = Payment::where('coupon_id', $coupon->id)->count();
        
        if($used >= $coupon->quantity){
            return redirect()->back()->withFlashDanger(trans('strings.backend.cannot-activate-exhausted'));
        }
        
        $coupons = Coupon::where('sitewide', true)->get();
        foreach($coupons as $c){
            $c->active = false;
            $c->save();
        }
        
        $coupon->active = true;
        $coupon->save();
        
        return back();
       
    }
    
    
    public function destroy($id)
    {
        if(config('demo.demo_mode') && $id < 4){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        Coupon::find($id)->delete();
        return back();
    }
}
