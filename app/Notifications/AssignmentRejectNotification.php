<?php

namespace App\Notifications;

use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentRejectNotification extends Notification implements ShouldQueue
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
            ->line("Your assignment titled '".$this->title."'. After review, I regret to inform you that your submission has been rejected.")
            ->line('Review Summary:')
            ->line('Score: '.$this->assignment->score)
            ->line('Status:  '.$this->assignment->status)
            ->line('Comments:  '.$this->assignment->comments)
            ->line('You are encouraged to revise your assignment based on the feedback provided above and resubmit it ')
            ->line('Please remember to focus on the highlighted areas for improvement to enhance your work. If you have any questions or need further clarification on the feedback, feel free to reach out. I’m here to assist you in your learning journey!')
            ->line('Thank you for your understanding, and I look forward to seeing your revised submission!')
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
