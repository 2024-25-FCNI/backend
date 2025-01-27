<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;

class FizetesController extends Controller
{
    public function sendPaymentConfirmation(Request $request)
    {
        $user = $request->user(); // Bejelentkezett felhasználó
        $kosar = $request->input('kosar'); // Kosár tartalma
        $total = $request->input('total'); // Végösszeg

        // Ellenőrizzük, hogy az adatok helyesek-e
        if (!$user || !$kosar || !$total) {
            return response()->json(['message' => 'Hibás adatok'], 400);
        }

        // E-mail küldés
        Mail::to($user->email)->send(new PaymentConfirmation($user, $kosar, $total));

        return response()->json(['message' => 'E-mail sikeresen elküldve']);
    }
}
