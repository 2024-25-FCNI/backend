<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = [
            'name' => $mailData['name'] ?? 'Vásárló',
            'total' => $mailData['total'] ?? 0,
            'kosar' => $mailData['kosar'] ?? [],
        ];
    }

    public function envelope(): \Illuminate\Mail\Mailables\Envelope
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Fizetési visszaigazolás',
            from: new \Illuminate\Mail\Mailables\Address('tesztproba20@gmail.com', 'Webshop')
        );
    }

    public function content(): \Illuminate\Mail\Mailables\Content
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'emails.demo',
            with: ['mailData' => $this->mailData]
        );
    }
}
