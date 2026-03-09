<?php

namespace App\Notifications;

use Domain\Quizzes\Models\QuizAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuizResultStudentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly QuizAttempt $quizAttempt)
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
        $correctPointsPercentage = get_points_percentage($this->quizAttempt->quiz->total_points ?? 0, $this->quizAttempt->earned_points ?? 0);
        if ($correctPointsPercentage >= 50) {
            $result = 'Passed';
        } else {
            $result = 'Failed';
        }

        return (new MailMessage)
            ->subject('Quiz Completion Notification')
            ->line('Hello '.$notifiable->name.',')
            ->line('You have finished the quiz. Here are your results:')
            ->line('Your Marks: '.$this->quizAttempt->earned_points)
            ->line('Correct Answer: '.$this->quizAttempt->correct_answers)
            ->line('Result: '.$result)
            ->line('If you did not pass, please take a moment to review the material and try again!');
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
