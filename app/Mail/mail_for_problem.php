<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class mail_for_problem extends Mailable
{
    use Queueable, SerializesModels;
     // in mail controller variable
     public $subject;
     public $messageDetails;

     public $administratorName;
     public $administratorEmail;
     public $administratorContactNumber;

     public $bankName;
     public $bankAddress;
     public $bankContactNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $messageDetails,
                                $administratorName, $administratorEmail, $administratorContactNumber, 
                                $bankName, $bankAddress, $bankContactNumber)
    {
        $this->subject= $subject;
        $this->messageDetails= $messageDetails;

        $this->administratorName= $administratorName;
        $this->administratorEmail= $administratorEmail;
        $this->administratorContactNumber= $administratorContactNumber;

        $this->bankName= $bankName;
        $this->bankAddress= $bankAddress;
        $this->bankContactNumber= $bankContactNumber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->administratorEmail, $this->administratorName),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.mailForProblem',
            with: [
                'subject' => $this->subject,
                'messageDetails' => $this->messageDetails,
                'administratorName' => $this->administratorName,
                'administratorEmail' => $this->administratorEmail,
                'administratorContactNumber' => $this->administratorContactNumber,
                'bankName' => $this->bankName,
                'bankAddress' => $this->bankAddress,
                'bankContactNumber' => $this->bankContactNumber,
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
        return [ ];
    }
}
