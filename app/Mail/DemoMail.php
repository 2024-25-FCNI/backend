<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth; // 🔥 Auth osztály importálása

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
        // Számoljuk ki a teljes összeget, ha nincs megadva
        $total = collect($mailData['kosar'] ?? [])->sum('ar');

        // 🔥 Biztosítjuk, hogy az Auth osztály működik, és van bejelentkezett felhasználó
        $name = $mailData['name'] ?? (Auth::check() ? Auth::user()->name : 'Vásárló');

        $this->mailData = [
            'name' => $name,
            'total' => $total,
            'kosar' => $mailData['kosar'] ?? [],
        ];
    }

    /**
     * A levél fejlécének beállítása.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fizetési visszaigazolás',
            from: new Address('tesztproba20@gmail.com', 'Webshop')
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
