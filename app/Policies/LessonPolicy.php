<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\Access\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Lesson $lesson)
    {
        return $user->canAccessLesson($lesson);
    }

}
