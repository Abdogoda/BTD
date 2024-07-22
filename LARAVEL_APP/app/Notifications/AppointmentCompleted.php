<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCompleted extends Notification
{
    use Queueable;

    public $appointment;
    public $message;
    public $report;

    public function __construct(array $appointment){
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array{
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage{
        if(isset($this->appointment['diagnosis']) && isset($this->appointment['report'])){
            $this->message = 'We hope this message finds you well. We are writing to provide you with a summary of your recent appointment with Dr. '.$this->appointment['doctor'].' on '.$this->appointment['date'];
            $this->report = new \Illuminate\Support\HtmlString('<div style="margin-top:20px"><h3>'.$this->appointment['diagnosis'].'</h3>'.$this->appointment['report'] . '</div>');
        }else{
            $this->message = 'We hope this message finds you well. We are writing to inform you that your recent appointment with Dr. '.$this->appointment['doctor'].' on '.$this->appointment['date'].' is completed successfully.';
            $this->report = '';
        }
        return (new MailMessage)
            ->mailer(env('MAIL_FROM_ADDRESS'))
            ->mailer(env('MAIL_MAILER'))
            ->subject('Appointment Completed')
            ->greeting('Dear '. $notifiable->first_name. ' '. $notifiable->last_name)
            ->line($this->message)
            ->line($this->report)
            ->line('Thank you for trusting us with your healthcare needs.');
    }

    public function toArray(object $notifiable): array{
        return [
            //
        ];
    }
}