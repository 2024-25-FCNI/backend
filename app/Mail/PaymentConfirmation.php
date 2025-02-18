<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $kosar;
    public $total;

    public function __construct($user, $kosar, $total)
    {
        $this->user = $user;
        $this->kosar = $kosar;
        $this->total = $total;
    }

    /**
     * E-mail boríték beállítása (Feladó, Tárgy)
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('noreply@webshop.com', 'Webshop Admin'),
            subject: 'Fizetés Visszaigazolása',
        );
    }

    /**
     * E-mail tartalom beállítása (Blade nézet)
     */
    public function content()
    {
        return new Content(
            view: 'emails.payment_confirmation',
            with: [
                'user' => $this->user,
                'kosar' => $this->kosar,
                'total' => $this->total,
            ],
        );
    }
}
