<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Access\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }

}
