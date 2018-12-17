<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Section;

class SectionTransformer extends TransformerAbstract
{
 
    public function transform(Section $section)
    {
        return [
            'id' => $section->id,
            'title' => $section->title,
            'description' => $section->objective,
            'created_at' => $section->created_at->toDateTimeString(),
            'created_at_human' => $section->created_at->diffForHumans(),
            'lessons' => $section->lessons
            
        ];
    }
}