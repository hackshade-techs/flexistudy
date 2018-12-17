<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Input;
use Cmgmyr\Messenger\Models\Participant;
use App\Transformers\ThreadsTransformer;
use App\Transformers\MessagesTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class MessageController extends Controller
{
    
    public function index()
    {
        $threads = Thread::getAllLatest()->ForUser(Auth::id())->paginate(12);
        $firstThread = $threads->first();
        return view('frontend._messaging.inbox', compact('threads', 'firstThread' ));
    }
    
    public function fetchThreads()
    {
        $threads = Thread::getAllLatest()->ForUser(Auth::id())->paginate(300);
        return fractal()
            ->collection($threads)
            ->transformWith(new ThreadsTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($threads))
            ->toArray();
    }
    
    public function getUnread()
    {
        $threads = Thread::getAllLatest()->ForUserWithNewMessages(Auth::id())->paginate(12);
        $inbox = Thread::getAllLatest()->get();
        $unread = Thread::getAllLatest()->ForUserWithNewMessages(Auth::id())->get()->count();
        return view('frontend._messaging.inbox', compact('threads'));
        
    }
    
    
    public function markThreadAsRead(Request $request)
    {
        $thread = Thread::findOrFail($request->thread);
        $thread->markAsRead(Auth::id());
        return response()->json(null, 200);
    }
    

    public function fetchThreadMessages($id)
    {
        $messages = Message::where('thread_id', $id)->paginate(200);
        return fractal()
            ->collection($messages)
            ->transformWith(new MessagesTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($messages))
            ->toArray();
    }
    
    public function getThreadMessages(User $user, $id)
    {
        $thread = Thread::findOrFail($id); 
        $messages = Message::where('thread_id', $id)->with('user', 'user.profileImage')->get();
        return response()->json($messages);
    }
    
    public function store()
    {
        //$role = Role::where('slug', 'admin')->first();
        
        $input = Input::all();

        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);
        // Message
        Message::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
        ]);
        // Sender
        Participant::create([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
        ]);
        // Recipients
        $users = $input['receiver_id'];
        
        $thread->addParticipant($users);
        return redirect()->back();
    }
    
    public function update(Request $request, $id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            notify()->flash('Error', 'error', [
                    'text' => 'The thread with ID: ' . $id . ' was not found.',
                ]); 
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        // Message
        Message::create([
            'thread_id' => $request->thread_id,
            'user_id'   => Auth::id(),
            'body'      => $request->body,
        ]);
        // Add replier as a participant
        $participant = Participant::firstOrCreate([
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
        ]);
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }
        
        if ($request->ajax()){
            return response()->json(null, 200);
        }
    }
    
    
   

}
