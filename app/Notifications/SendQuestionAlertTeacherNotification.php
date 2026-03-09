<?php

namespace App\Notifications;

use Domain\Courses\Models\Course;
use Domain\Courses\Models\CourseQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendQuestionAlertTeacherNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly CourseQuestion $question, protected readonly Course $course)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Question Alert Notificaiton')
            ->line('Hi '.$notifiable->name.',')
            ->line('You have new question to answer')
            ->line('Course: "'.$this->question->course->name.'"')
            ->line('Question: "'.$this->question->name.'"')
            ->line('Please log into the portal and review the Q&A section. Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
