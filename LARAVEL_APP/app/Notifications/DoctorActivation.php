<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorActivation extends Notification{

    use Queueable;

    
    /**
     * Create a new notification instance.
     */
    public function __construct(){
    }

    public function via(object $notifiable): array{
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage{
        return (new MailMessage)
            ->mailer(env('MAIL_MAILER'))
            ->subject('Doctor Account Activated')
            ->greeting("Hello Dr/ ". $notifiable->first_name. ' '. $notifiable->last_name)
            ->line('You Account Has Been Activated Successfully')
            ->line('You can update your profile now, to improve your chances to be visited.')
            ->line('Try our AI detection models now and enjoy our application.')
            ->line('Thank you for using our application!');
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