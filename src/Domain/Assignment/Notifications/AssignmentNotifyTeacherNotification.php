<?php

namespace Domain\Assignment\Notifications;

use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentNotifyTeacherNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly ?string $notes, protected readonly Course $course, protected readonly User $student)
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
            ->subject('Assignment Submission Notification')
            ->line('Dear '.$notifiable->name.',')
            ->line('This is to inform you that a student has submitted their assignment on the LMS.')
            ->line('Course: '.$this->course->name.'"')
            ->line('Student Name: '.$this->student->name.'"')
            ->line('Assignment Title: '.$this->notes)
            ->line('Submission Time: '.now())
            ->line('Please log in to the portal to review the submission.');

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
