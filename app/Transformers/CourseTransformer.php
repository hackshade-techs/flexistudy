<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Course;

class CourseTransformer extends TransformerAbstract
{
 
    public function transform(Course $course)
    {
        return [
            'id' => $course->id,
            'title' => $course->title,
            'average_rating' => $course->average_rating,
            'total_reviews' => $course->total_reviews,
            'category' => $course->category->name,
            'category_id' => $course->category->id,
            'author' => $course->author
        ];
    }
}