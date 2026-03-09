<?php

namespace App\Notifications;

use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentReminderNotification extends Notification
{
    use Queueable;

    protected $submission;

    /**
     * Create a new notification instance.
     */
    public function __construct(SubmittedAssignment $submission)
    {
        $this->submission = $submission;
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
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Assignment Grading Reminder')
            ->line("Assignment Name: {$this->submission->name} has been pending for 7 days.")
            ->line('Please give it grades and mark it as complete')
            ->action('View Assignment', url('/assignments/'.$this->submission->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'submission_id' => $this->submission->id,
            'assignment_id' => $this->submission->submissionable_id,
            'message' => 'Assignment pending grading for 7 days.',
        ];
    }
}
