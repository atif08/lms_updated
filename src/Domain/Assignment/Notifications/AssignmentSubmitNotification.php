<?php

namespace Domain\Assignment\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentSubmitNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly ?string $notes, protected readonly string $title)
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
            ->subject('Your Assignment Has Been Successfully Submitted!')
            ->line('Hi '.$notifiable->name.',')
            ->line('Congratulations! Your assignment titled "'.$this->title.' has been successfully submitted. Submission Summary:')
            ->line('Assignment Title: '.$this->title)
            ->line('Submitted On: '.now())
            ->line('Rest assured that your work is now in our system. I will begin reviewing submissions shortly, You can expect your feedback and grade to be posted in the course portal shortly after grading is complete.')
            ->line("If you realize you've made an error or wish to submit a revised version, please contact me as soon as possible. If you have any questions or need further assistance regarding the assignment, feel free to reach out!")
            ->line('Thank you for your hard work, and good luck with the rest of your studies!');

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
