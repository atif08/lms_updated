<?php

namespace App\Notifications;

use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarEventNotification extends Notification implements ShouldQueue
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
            ->subject('New Event Created: '.$this->calendar->title)
            ->line('Dear '.$notifiable->name.',')
            ->line('This is an automated notification to inform you that a new event has been added to the calendar.')
            ->line('Event Details: ')
            ->line('Event Name: '.$this->calendar->title)
            ->line('Description: '.$this->calendar->description)
            ->line('Start Date: '.format_date($this->calendar->start_datetime))
            ->line('End Date: '.format_date($this->calendar->end_datetime));
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
