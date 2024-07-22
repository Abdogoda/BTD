<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookAppointment extends Notification{
    
    use Queueable;

    public $appointment;

    public function __construct(array $appointment){
        $this->appointment = $appointment;
    }

    public function via(object $notifiable): array{
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage{
        return (new MailMessage)
            ->mailer(env('MAIL_FROM_ADDRESS'))
            ->mailer(env('MAIL_MAILER'))
            ->subject('Appointment Booked')
            ->greeting('Hello '. $notifiable->first_name. ' '. $notifiable->last_name)
            ->line('You have successfully booked an appointment.')
            ->line('Here are the details of your appointment:')
            ->line(new \Illuminate\Support\HtmlString(
                '<table style="border: 1px solid black; border-collapse: collapse; margin:auto; margin-bottom:20px; width: 300px;">
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Name</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['name'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Phone</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['phone'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Age</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['age'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Gender</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['gender'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Doctor</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['doctor'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Clinic</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['clinic'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Clinic Address</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['clinic_address'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Clinic Phone</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['clinic_phone'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Day</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['day'] . ' ' . $this->appointment['date']  . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Time</td>
                        <td style="border: 1px solid black; padding: 5px;">' . Carbon::createFromFormat('H:i:s', $this->appointment['time'])->format('h:i A') . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Number</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['number'] . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Price</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['price'] . 'EGP</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">Type</td>
                        <td style="border: 1px solid black; padding: 5px;">' . $this->appointment['type'] . '</td>
                    </tr>
                </table>'))
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array{
        return [
            //
        ];
    }
}