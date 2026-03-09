<?php

namespace App\Notifications;

use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarBatchNotification extends Notification implements ShouldQueue
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
            ->subject('Important Update for : '.$this->calendar->batch->name)
            ->line('Dear '.$notifiable->name.',')
            ->line('I am reaching out to share an important update regarding your batch:')
            ->line('Batch: '.$this->calendar->batch->name)
            ->line('Details: '.$this->calendar->description)
            ->line('Feel free to get in touch should you have any questions.')
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
