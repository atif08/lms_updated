<?php

namespace App\Notifications;

use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarClassesNotification extends Notification implements ShouldQueue
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

        $mailMessage = (new MailMessage)
            ->subject('Upcoming Class Reminder: '.$this->calendar->title)
            ->line('Dear '.$notifiable->name.',')
            ->line('This is an automated reminder about your upcoming class.')
            ->line('Class Details:')
            ->line('Title: '.$this->calendar->title)
            ->line('Description: '.$this->calendar->description)
            ->line('Start Date & Time: '.format_date($this->calendar->start_datetime))
            ->line('End Date & Time:: '.format_date($this->calendar->end_datetime));

        if (! empty($this->calendar->url)) {
            $mailMessage->action('Join', $this->calendar->url);
        }

        return $mailMessage->line('Thank you.');
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
