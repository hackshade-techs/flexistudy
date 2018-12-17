<?php

namespace App\Transformers;

use Helper;
use App\Models\Review;
use League\Fractal\TransformerAbstract;


class ReviewTransformer extends TransformerAbstract
{
 
    public function transform(Review $review)
    {
        return [
            'id' => $review->id,
            'rating' => $review->rating,
            'comment' => $review->comment,
            'created_at' => $review->created_at->toDateTimeString(),
            'created_at_human' => $review->created_at->diffForHumans(),
            'author_image' => $review->user->picture,
            'author' => $review->user
        ];
    }
}