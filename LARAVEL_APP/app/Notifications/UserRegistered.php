<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification{
    use Queueable;

    
    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    public $type;
    /**
     * Create a new notification instance.
     */
    public function __construct(){
        $this->message = "You Have Just Created Your Account Successfully";
        $this->subject = "New Account Created";
        $this->fromEmail = env('MAIL_FROM_ADDRESS');
        $this->mailer = env('MAIL_MAILER');
    }

    public function via(object $notifiable): array{
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage{
        $this->message = 'You have just created your new account successfully, Please verify your email address for ensure identity.';
        if ($notifiable->role == 'doctor'){
            $this->message = 'You have just created your new account successfully, Please wait untill the admin review your request and activate your account. Once your account is activated, we will send an email to inform you with that.';
        }else if($notifiable->role == 'admin'){
            $this->message = 'Your account is now an admin in our BTD website, please login to view your account.';
        }
        return (new MailMessage)
            ->mailer($this->mailer)
            ->subject($this->subject)
            ->greeting("Hello ". $notifiable->first_name. ' '. $notifiable->last_name)
            ->line($this->message);
    }

    public function toArray(object $notifiable): array{
        return [
            //
        ];
    }
}