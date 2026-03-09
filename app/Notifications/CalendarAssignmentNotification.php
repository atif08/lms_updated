<?php

namespace App\Notifications;

use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly CalendarEvent $calendar)
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
            ->subject('Reminder: Upcoming Assignment - '.$this->calendar->title.' Due on '.format_date($this->calendar->start_datetime))
            ->line('Dear '.$notifiable->name.',')
            ->line('This is an automated reminder about your upcoming assignment for '.$this->calendar->course->name)
            ->line('Assignment Overview:')
            ->line('Title: '.$this->calendar->title)
            ->line('Due Date & Time: '.format_date($this->calendar->start_datetime))
            ->line('Submission Format: PDF Only')
            ->line('If you are facing challenges that prevented you from submitting on time, please reach out to your instructor to discuss your situation.')
            ->line('Thank you.');

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
