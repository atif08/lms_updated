<?php

namespace App\Notifications;

use Domain\Payments\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentConfirmedNotification extends Notification
{
    use Queueable;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Payment Confirmed - '.$this->payment->course->name)
            ->greeting('Hello '.$notifiable->name.'!')
            ->line('Your payment for the course "'.$this->payment->course->name.'" has been confirmed.')
            ->line('Amount: '.$this->payment->amount)
            ->line('you are allow to access course now')
            ->action('Go to Course', route('courses.get.details', $this->payment->course->slug))
            ->line('Thank you for choosing British University College!');
    }
}
