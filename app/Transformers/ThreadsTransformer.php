<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Cmgmyr\Messenger\Models\Thread;
use App\Helpers\Helper;
use Auth;

class ThreadsTransformer extends TransformerAbstract
{
 
    public function transform(Thread $thread)
    {
        
        return [
            'id' => $thread->id,
            'subject' => $thread->subject,
            'created_at' => $thread->created_at->diffForHumans(),
            'creator' => $thread->creator()->name,
            'isUnread' => $thread->isUnread(Auth::id()),
            'creator_image' => $thread->creator()->picture
        ];
        
    }
}