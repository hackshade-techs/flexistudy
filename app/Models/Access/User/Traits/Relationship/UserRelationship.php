<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\Course;

use App\Models\QuizAttempt;
use App\Models\Answer;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Bookmark;
use App\Models\Question;
use App\Models\Withdrawal;
use App\Models\Completion;
use App\Models\System\Session;
use App\Models\HelpfulAnswer;
use App\Models\Announcement;
use App\Models\QuestionFollow;
use App\Models\SystemMessage;
use App\Models\AnnouncementComment;
use App\Models\Access\User\SocialLogin;
use App\Models\Access\OauthAccessToken;
use Cmgmyr\Messenger\Models\Message as Msg;


/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    
    public function oauthToken()
    {
        return $this->hasOne(OauthAccessToken::class);
    }
    
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), 'user_id', 'role_id');
    }
    
    public function inbox()
    {
        return $this->hasMany(Msg::class);
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    
    public function completions()
    {
        return $this->hasMany(Completion::class);
    }
    
    public function hasCompleted($lesson)
    {
        return (bool)$this->completions->where('lesson_id', $lesson->id)->count();
    }
    
    
    public function bookmarkedCourses()
    {
        return $this->belongsToMany(Course::class, 'bookmarks');
    }
    
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }
    
    public function authored_courses()
    {
        return $this->hasMany(Course::class);
    }
    
    public function canReviewCourse($course)
    {
        return $this->id != $course->user_id && !(bool)$this->reviews->where('course_id', $course->id)->count()  && (bool)$this->enrollments()->where('course_id', $course->id)->count();
    }
    
    public function enrollments()
    {
        return $this->belongsToMany(Course::class);
    }
    
    public function canAccessLesson($lesson)
    {

        return (bool)$this->enrollments->where('course_id', $lesson->course_id)->count() 
                || (bool)$this->authored_courses->where('id', $lesson->section->course_id)->count()
                || (bool)$this->hasRole(1)
                || (bool)$lesson->preview;
            
    }
    
    public function students()
    {
        $my_courses = $this->authored_courses;
        foreach($my_courses as $c){
            $c->enrollment_count = $c->students->count();
        }
        return $my_courses;
    }
    
    public function hasBookmarked($course)
    {
        return (bool) $this->bookmarks->where('course_id', $course->id)->count();
    }
    
    public function comments()
    {
        return $this->hasMany(AnnouncementComment::class);
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function questionFollows()
    {
        return $this->hasMany(QuestionFollow::class);
    }
    
    public function followedQuestions()
    {
        return $this->belongsToMany(QuestionFollow::class, 'question_follows');
    }
    
    public function hasFollowed($question)
    {
        return (bool) $this->questionFollows->where('question_id', $question->id)->count();
    }
    
    // answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function markedAnswers()
    {
        return $this->hasMany(HelpfulAnswer::class);
    }
    
    public function hasMarked($answer)
    {
        return (bool) $this->markedAnswers->where('answer_id', $answer->id)->count();
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function system_messages()
    {
        return $this->belongsToMany(SystemMessage::class, 'system_message_user', 'user_id', 'system_message_id');
    }
    
    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    
    
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
