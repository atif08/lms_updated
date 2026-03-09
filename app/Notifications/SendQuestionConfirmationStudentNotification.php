<?php

namespace App\Notifications;

use Domain\Courses\Models\Course;
use Domain\Courses\Models\CourseQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendQuestionConfirmationStudentNotification extends Notification implements ShouldQueue
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
            ->subject('Currently Reviewing Your Question')
            ->line('Hi '.$notifiable->name.',')
            ->line('I hope this message finds you well. I wanted to inform you that I’ve received your question regarding "'.$this->question->course->name.'". I am currently reviewing it and will provide a detailed response shortly.')
            ->line('In the meantime, if you come across any additional details or have further questions, don’t hesitate to let me know.')
            ->line('Thank you for your patience!');
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
