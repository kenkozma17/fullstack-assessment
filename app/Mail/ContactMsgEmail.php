<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMsgEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;

    /**
     * Create aa new message instance.
     *
     * @return void
     */
    public function __construct($newMsg)
    {
        // Construct email and define parts
        $this->body = $newMsg->message;
        $this->subject($newMsg->subject);
        $this->from('developer-test@liquidfish.com');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-msg');
    }
}
