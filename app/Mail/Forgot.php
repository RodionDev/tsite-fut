<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class Forgot extends Mailable
{
    use Queueable, SerializesModels;
    private $link;
    public $subject = "Wachtwoord vergeten?";
    public function __construct($link)
    {
        $this->link = $link;
    }
    public function build()
    {
        return $this->markdown('emails/reset')->with(['link' => $this->link]);
    }
}
