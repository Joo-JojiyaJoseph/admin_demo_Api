<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $attachment;
    public $message;
    public $subject;

    public function __construct($message)
    {
        $this->message = $message;
        $this->subject = "New Contact";
    }

    public function build()
    {
        return $this->subject($this->subject)
        ->markdown('emails.contact', ['message' => $this->message])->attach($this->attachment);
    }

}
