<?php

namespace App\Mail\Messages;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $messageSubject;
    public $messageContent;
    public $messageFrom;

    public function __construct($from, $subject, $message)
    {
        $this->messageFrom    = $from;
        $this->messageSubject = $subject;
        $this->messageContent = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->messageFrom->email)
                    ->subject($this->messageSubject)
                    ->markdown('emails.messages.new_message');
    }
}
