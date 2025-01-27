<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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

    public function build()
    {
        return $this->subject('Fizetés Visszaigazolása')
                    ->view('emails.payment_confirmation');
    }
}
