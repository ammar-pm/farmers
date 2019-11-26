<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $url = url('users/' . $this->message->id . '/edit');

        return $this->markdown('emails.register')->with(['url' => $url])->subject('New user has signed up on indicators.ps');

    }

}