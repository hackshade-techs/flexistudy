<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\AnnouncementComment;

class AnnouncementCommentTransformer extends TransformerAbstract
{
 
    public function transform(AnnouncementComment $comment)
    {
        return [
            'id' => $comment->id,
            'announcement' => $comment->announcement_id,
            'body' => $comment->body,
            'created_at_human' => $comment->created_at->diffForHumans(),
            'updated_at_human' => $comment->created_at != $comment->updated_at ? $comment->updated_at->diffForHumans() : null,
            'user' => $comment->user
            
        ];
    }
}