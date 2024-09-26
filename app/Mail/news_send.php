<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Auth;

class news_send extends Mailable
{
    use Queueable, SerializesModels;

    public $announcement;
    public $superAdminEmail;
    public $superAdminName;

    /**
     * Create a new announcement instance.
     */
    public function __construct($announcement, $superAdminEmail, $superAdminName)
    {
        $this->announcement= $announcement;
        $this->superAdminEmail = $superAdminEmail;
        $this->superAdminName = $superAdminName;
    }

    /**
     * Get the announcement envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(Auth::user()->email, Auth::user()->name),
            subject: 'Announcements from NanoSoft Solutions (Pvt)Ltd',
        );
    }

    /**
     * Get the announcement content definition.
     */
    public function content(): Content
    {
        return new Content(
            //email content file
            view: 'mail.news',
            with: [
                'announcement' => $this->announcement,
            ],
        );
    }

    /**
     * Get the attachments for the announcement.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
