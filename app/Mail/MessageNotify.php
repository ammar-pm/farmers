<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $subject;
    public $template;

    public function __construct($subject,$message,$template)
    {
        $this->message = $message;
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //$url = url('users/' . $this->message->id . '/edit');
        return $this->markdown('emails.' . $this->template)->subject($this->subject);
        //return $this->markdown('emails.register')->with(['url' => $url])->subject('New user has signed up on indicators.ps');

    }

}