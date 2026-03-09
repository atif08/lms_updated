<?php

namespace App\Notifications;

use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentReminderNotificationAdmin extends Notification
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
        $assignment = $this->submission->submissionable; // Assignment model
        $assignmentName = $assignment->title ?? $assignment->name ?? 'Assignment';

        $student = $this->submission->user?->name ?? 'Student';
        $instructor = $assignment?->course?->teachers?->first()?->name ?? 'Instructor';

        return (new MailMessage)
            ->subject('Teacher Has Not Graded Assignment (7-Day Reminder)')
            ->line("The instructor **{$instructor}** has not graded an assignment for 7 days.")
            ->line("Assignment: **{$assignmentName}**")
            ->line("Submitted by: **{$student}**")
            ->action('View Submission', url('/assignments/'.$this->submission->id))
            ->line('Please follow up with the instructor.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'submission_id' => $this->submission->id,
            'assignment_id' => $this->submission->submissionable_id,
            'message' => 'Teacher has not graded the assignment for 7 days.',
        ];
    }
}
