<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Cmgmyr\Messenger\Models\Message;
use App\Helpers\Helper;
use Auth;


class MessagesTransformer extends TransformerAbstract
{
 
    public function transform(Message $message)
    {
        
        return [
            'id' => $message->id,
            'body' => $message->body,
            'created_at' => $message->created_at->diffForHumans(),
            'creator' => $message->user->name,
            'creator_id' => $message->user->id,
            'creator_image' => $message->user->picture,
            'auth_user' => Auth::id()
        ];
        
    }
}