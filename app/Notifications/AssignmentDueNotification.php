<?php

namespace App\Notifications;

use Domain\Courses\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentDueNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly Topic $topic)
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
            ->subject('Reminder: Assignment Due Tomorrow - '.$this->topic->name)
            ->line('Dear '.$notifiable->name.',')
            ->line("This is an automated reminder that your assignment for the topic {$this->topic->name} is due tomorrow, {$this->topic->assignment_submit_date}. Please ensure that your submission is completed and uploaded by the deadline.")
            ->line('If you have any questions or need assistance, please contact your instructor.')
            ->line('Thank you, and good luck with your assignment!');
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
