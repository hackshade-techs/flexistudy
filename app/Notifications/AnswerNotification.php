<?php

namespace App\Notifications;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AnswerNotification extends Notification
{
    use Queueable;
    
    protected $answer;
    protected $question;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Answer $answer, Question $question)
    {
        $this->answer = $answer;
        $this->question = $question;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(trans('strings.frontend.new-answer') . ': ' . $this->question->title)
                    ->line(trans('strings.frontend.new-answer-posted') . ':<b>' . $this->question->title . '</b>')
                    ->action(trans('strings.frontend.view-it-here'), url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'question_id' => $this->question->id,
            'question_title' => $this->question->title,
            'question_slug' => $this->question->slug,
            'answer_id' => $this->answer->id,
            'course_slug' => $this->question->course->slug
        ];
    }
}
