<?php

namespace App\Notifications;

use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarCourseNotification extends Notification implements ShouldQueue
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
            ->subject('Course Update: '.$this->calendar->course->name)
            ->line('Dear '.$notifiable->name.',')
            ->line('I hope this message finds you well. Please find the details concerning your course below:')
            ->line('Course Title: '.$this->calendar->course->name)
            ->line('Schedule: '.format_date($this->calendar->start_datetime))
            ->line('Should you have any inquiries, please do not hesitate to reach out.')
            ->line('Your '.config('app.name'));
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
