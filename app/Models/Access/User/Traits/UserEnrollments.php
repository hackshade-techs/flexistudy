<?php

namespace App\Models\Access\User\Traits;
use Auth;

trait UserEnrollments
{
    
    /**
     * Checks if the user has enrolled to a course using courseId
     *
     * @param string $course Course object.
     *
     * @return bool
     */
    public function hasEnrolled($course)
    {
        
        foreach($this->enrollments as $enrollment){
            
            if($enrollment->id == $course->id){
                return true;
            }
        }
        
        if($course->author->id == $this->id || $this->hasRole('Administrator') ){
            return true;
        }

        return false;
    }
    
}