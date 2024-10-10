<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;  // Data passed from the form

    protected $resume;  // Store resume file

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string|null $resume
     */
    public function __construct(array $data, $resume = null)
    {
        $this->data = $data;  // Form data
        $this->resume = $resume;  // Uploaded resume path
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Mail',  // Email subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.application',  // Reference to the Markdown view
            with: [
                'data' => $this->data,  // Pass form data to the view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->resume) {
            // Attach resume file if it exists
            $attachments[] = Attachment::fromPath(storage_path('app/public/' . $this->resume));
        }

        return $attachments;
    }
}
