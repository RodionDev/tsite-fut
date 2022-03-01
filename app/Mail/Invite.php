<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class Invite extends Mailable
{
    use Queueable, SerializesModels;
    private $token;
    public function __construct($token)
    {
        $this->token = $token;
    }
    public function build()
    {
        return $this->view('emails/invite')->with(['register_url' => $this->token]);
    }
}
