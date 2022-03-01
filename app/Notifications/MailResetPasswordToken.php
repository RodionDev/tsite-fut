<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class MailResetPasswordToken extends Notification
{
    use Queueable;
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }
    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Je wachtwoord resetten")
            ->line("Hey, ben jij je wachtwoord vergeten? Klik op de knop om hem te resetten.")
            ->action('Wachtwoord resetten', route('reset.password.token', ['token' => $this->token]))
            ->line('Met vriendelijke groet,')
            ->salutation('Futsal Club Heerenveen');
    }
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
