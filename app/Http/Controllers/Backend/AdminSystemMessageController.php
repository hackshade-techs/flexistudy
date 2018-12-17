<?php

namespace App\Http\Controllers\Backend;

use App\Models\SystemMessage;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Notifications\SystemMessageNotification;

class AdminSystemMessageController extends Controller
{
    
    
    public function index(Request $request)
    {
        if($request->filter == 'sent'){
            $messages = SystemMessage::latest()->with('users')->where('sent', true)->get();
            $filter = 'sent';
        } elseif ($request->filter == 'draft'){
            $messages = SystemMessage::latest()->with('users')->where('sent', false)->get();
            $filter = 'draft';
        } else {
            $messages = SystemMessage::latest()->with('users')->get();
            $filter = 'all';
        }
        return view('backend._messages.index', compact('messages', 'filter'));
    }
    
    public function create()
    {
        $users = User::orderBy('first_name')->where('id', '<>', auth()->user()->id)->get();
        return view('backend._messages.create', compact('users'));
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'subject' => 'required',
            'body'    => 'required'
        ]);
        
        if($request->recipient_group == 'authors'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', 'Author');
            })->pluck('id');
        } elseif ($request->recipient_group == 'students'){
            $recipients = User::has('enrollments')->pluck('id');
        } elseif ($request->recipient_group == 'inactive-users'){
            $recipients = User::where('status', false)->pluck('id');
        } elseif ($request->recipient_group == 'everyone'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', '<>', 'Administrator');
            })->pluck('id');
        } elseif ($request->recipient_group == 'admins'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', '=', 'Administrator');
            })->pluck('id');
        } else {
            $recipients = explode(',', $request->recipients);
        }

        if(!count($recipients)){
            return redirect()->back()->withFlashDanger(trans('strings.backend.recipient-empty'));    
        }
        
        $message = new SystemMessage();
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->recipient_group = $request->recipient_group;
        $message->save();

        $message->users()->attach($recipients);
        
        return redirect()->route('admin.messages.index');
    }
    
    public function edit($id)
    {
        $users = User::orderBy('first_name')->where('id', '<>', auth()->user()->id)->get();
        $message = SystemMessage::find($id);
        
        //$r = implode(',', ($message->users->pluck('id')));
        //$recipients = $r->toArray();
        
        $recipients = $message->users->pluck('id');
        
        return view('backend._messages.edit', compact('message', 'users', 'recipients'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'body'    => 'required',
            'recipient_group'    => 'required|in:everyone,admins,authors,students,inactive-users,selected-users'
        ]);
        
        if($request->recipient_group == 'authors'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', 'Author');
            })->pluck('id');
        } elseif ($request->recipient_group == 'students'){
            $recipients = User::has('enrollments')->pluck('id');
        } elseif ($request->recipient_group == 'inactive-users'){
            $recipients = User::where('status', false)->pluck('id');
        } elseif ($request->recipient_group == 'everyone'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', '<>', 'Administrator');
            })->pluck('id');
        } elseif ($request->recipient_group == 'admins'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', '=', 'Administrator');
            })->pluck('id');
        } else {
            $recipients = explode(',', $request->recipients);
        }
        if(!count($recipients)){
            return redirect()->back()->withFlashDanger('The recipient list is empty. Please change the recipient group and try again');    
        }
        $message = SystemMessage::find($id);
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->recipient_group = $request->recipient_group;
        $message->save();
        
        $message->users()->detach();
        $message->users()->attach($recipients);
        
        return redirect()->route('admin.messages.index');
    }
    
    public function send($id)
    {
        if(config('demo.demo_mode')){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $message = SystemMessage::find($id);
        
        if($message->recipient_group == 'authors'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', 'Author');
            })->get();
        } elseif ($message->recipient_group == 'students'){
            $recipients = User::has('enrollments')->get();
        } elseif ($message->recipient_group == 'inactive-users'){
            $recipients = User::where('status', false)->get();
        } elseif ($message->recipient_group == 'everyone'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', '<>', 'Administrator');
            })->get();
        } elseif ($message->recipient_group == 'admins'){
            $recipients = User::whereHas('roles', function($q){
                $q->where('name', '=', 'Administrator');
            })->get();
        } else {
            $recipients = $message->users;
        }

        // create notification for the recipients
        foreach($recipients as $user){
            $user->notify(new SystemMessageNotification($message));
        }
        
        $message->sent = true;
        $message->save();
        
        $message->users()->detach();
        $message->users()->attach($recipients);
        
        return redirect()->back()->withFlashSuccess('Message has been sent to the selected recipients');    
        
    }
    
    public function destroy($id)
    {
        SystemMessage::find($id)->delete();
        return redirect()->back()->withFlashSuccess('Deleted');    
    }
    
}
