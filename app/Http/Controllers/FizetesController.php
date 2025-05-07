<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\DemoMail;

class FizetesController extends Controller
{
    public function sendPaymentConfirmation(Request $request)
    {
        $user = Auth::user(); // Bejelentkezett felhasználó
        $kosar = $request->input('kosar'); // Kosár tartalma
        $total = $request->input('total'); // Végösszeg

        // Ellenőrzés
        if (!$user || !$kosar || !$total) {
            return response()->json(['message' => 'Hibás adatok'], 400);
        }

        // E-mail adatok beállítása
        $mailData = [
            'title' => 'Fizetési visszaigazolás',
            'body' => "Köszönjük a vásárlást, {$user->name}!\nÖsszeg: {$total} Ft",
            'kosar' => $kosar,
            'name' => $user->name,
            'total' => $total,
        ];

        // E-mail küldés
        try {
            Mail::to($user->email)->send(new DemoMail($mailData));
            return response()->json(['message' => 'E-mail sikeresen elküldve!']);
        } catch (\Exception $e) {
            Log::channel('single')->error("E-mail küldési hiba: " . $e->getMessage());
            return response()->json(['message' => $mailData], 500);
        }
    }
}
