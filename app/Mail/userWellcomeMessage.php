<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class userWellcomeMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $userType;
    public $userEmail;
    public $userContactNumber;
    public $userPassword;

    public $RegisterAdminName;
    public $RegisterUserType;
    public $RegisterAadminEmail;
    public $RegisterAdminContactNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $userType, $userEmail, $userContactNumber, $userPassword,
                                  $RegisterAdminName, $RegisterUserType, $RegisterAadminEmail, $RegisterAdminContactNumber  )
    {
        $this->userName= $userName;
        $this->userType= $userType;
        $this->userEmail= $userEmail;
        $this->userContactNumber= $userContactNumber;
        $this->userPassword= $userPassword;

        $this->RegisterAdminName= $RegisterAdminName;
        $this->RegisterUserType= $RegisterUserType;
        $this->RegisterAadminEmail= $RegisterAadminEmail;
        $this->RegisterAdminContactNumber= $RegisterAdminContactNumber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->RegisterAadminEmail, $this->RegisterAdminName),
            subject: 'Welcome message regarding registration to Bank Complaning webApplication',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.userRegisterWellcomeMessage',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
