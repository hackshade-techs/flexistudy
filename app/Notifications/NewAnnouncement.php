<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewAnnouncement extends Notification
{
    use Queueable;
    
    protected $announcement;
    protected $course;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement, Course $course)
    {
        $this->announcement = $announcement;
        $this->course = $course;
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
                    ->subject(trans('strings.frontend.new-announcement'))
                    ->line(trans('strings.frontend.new-announcement-pubished') . $this->course->title)
                    ->action(trans('strings.frontend.view-it-here'), url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array // or toDatabase
     */
    public function toArray($notifiable)
    {
        return [
            'course_id' => $this->course->id,
            'course_title' => $this->course->title,
            'course_slug' => $this->course->slug,
            'announcement_id' => $this->announcement->id,
            'announcement_title' => $this->announcement->title
        ];
    }
}
