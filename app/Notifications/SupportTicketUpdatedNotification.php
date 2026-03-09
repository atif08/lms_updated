<?php

namespace App\Notifications;

use App\Models\SupportTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportTicketUpdatedNotification extends Notification
{
    use Queueable;

    protected $supportTicket;

    /**
     * Create a new notification instance.
     */
    public function __construct(SupportTicket $supportTicket)
    {
        $this->supportTicket = $supportTicket;
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
            ->subject('Support Ticket Status Updated')
            ->line('Status: '.$this->supportTicket->status)
            ->line('Topic: '.$this->supportTicket->topic)
//                    ->line('Description: ' . $this->supportTicket->description)
            ->action('View Ticket', url('/admin/support-tickets/'.$this->supportTicket->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'support_ticket_id' => $this->supportTicket->id,
            'topic' => $this->supportTicket->topic,
            'description' => $this->supportTicket->description,
        ];
    }
}
