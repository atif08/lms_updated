<?php

namespace App\Notifications;

use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarNoticeNotification extends Notification implements ShouldQueue
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
            ->subject('Important Notice: '.$this->calendar->title)
            ->line('Dear '.$notifiable->name.',')
            ->line('This is an automated notice regarding the upcoming policy update.')
            ->line('Notice Details:')
            ->line('Title: '.$this->calendar->title)
            ->line('Date Effective: '.format_date($this->calendar->start_datetime))
            ->line('Description: '.$this->calendar->description);

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
