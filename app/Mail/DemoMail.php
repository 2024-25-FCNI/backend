<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * A levél adatait tároló változó.
     */
    public $mailData;

    /**
     * Új példány létrehozása.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * A levél fejlécének beállítása.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demo Mail',
        );
    }

    /**
     * A levél tartalmának beállítása.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.demo', 
        );
    }

    /**
     * A levélhez csatolmányokat adhatunk meg.
     */
    public function attachments(): array
    {
        return [];
    }
}
