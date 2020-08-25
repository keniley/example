<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Message;

class MessageFromWeb extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * Message model
    *
    * @var App\Model\Message
    */
    public $message;

    /**
     * Create a new message instance.
     *
     * @param App\Model\Message $message
     *
     * @return void
     */
    public function __construct(Message $message)
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
        return $this->subject('Odeslán dotaz pro Avantinu')->markdown('emails.message2');
        //->view('emails.message');
    }
}
