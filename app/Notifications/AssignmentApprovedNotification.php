<?php

namespace App\Notifications;

use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly ?string $comments, protected readonly SubmittedAssignment $assignment, protected readonly string $title)
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
            ->subject('Assignment Review Completed')
            ->line('Dear '.$notifiable->name.',')
            ->line("Your assignment titled '".$this->title."' has been reviewed. Below are the details of your submission:")
            ->line('Review Summary:')
            ->line('Score: '.$this->assignment->score)
            ->line('Status:  '.$this->assignment->status)
            ->line('Comments:  '.$this->assignment->comments)
            ->line('If your assignment has been approved, great job! We appreciate your hard work and dedication.')
            ->line('You can view your score and comments in the course portal as well.')
            ->line('Thank you for your effort, and keep up the great work!')
            ->line('Best regards,');
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
