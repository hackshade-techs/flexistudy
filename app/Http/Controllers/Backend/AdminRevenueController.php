<?php

namespace App\Http\Controllers\Backend;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Access\Course\ManageCourseRequest;


class AdminRevenueController extends Controller
{
    // index
    public function index(Request $request)
    {
        $filter = $request->filter;
        return view('backend._revenue.index', compact('filter'));
    }
    
    // fetch
    public function fetch(Request $request)
    {
        if(!is_null($request->filter)){
            $withdrawals = Withdrawal::where('status', $request->filter)->with('user')->get();
        }else {
            $withdrawals = Withdrawal::with('user')->get();
        }
        
        return Datatables::of($withdrawals)
            ->addColumn('account_balance', function($withdrawal){
                return $withdrawal->user->account_balance();
            })
            ->addColumn('action', function ($withdrawal) {
                return '<a href="#" data-backdrop="static" data-keyboard="false" class="updateWithdrawal btn btn-primary btn-sm" data-toggle="modal" data-id="'.$withdrawal->id.'" data-status="'. $withdrawal->status .'" data-comment="'. $withdrawal->comment .'" data-target="#updateWithdrawal">
                            '. trans('labels.backend.withdrawal.update-request') .'
                        </a>';
            })
            ->make(true);
            
            
    }
    
    
    // show
    public function updateStatus(Request $request)
    {
        $withdrawal = Withdrawal::find($request->withdrawal_id);
        $withdrawal->status = $request->status;
        $withdrawal->comment = $request->comment;
        $withdrawal->save();
        
        return redirect()->back();
    }
    
    
    
    public function destroy()
    {
        
    }
    
    
}
