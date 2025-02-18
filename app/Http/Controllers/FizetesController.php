<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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

        // E-mail küldés
        try {
            Mail::to($user->email)->send(new PaymentConfirmation($user, $kosar, $total));
            return response()->json(['message' => 'E-mail sikeresen elküldve!']);
        } catch (\Exception $e) {
            Log::channel('single')->error("E-mail küldési hiba: " . $e->getMessage());
            return response()->json(['message' => 'Nem sikerült elküldeni az e-mailt.'], 500);
        }
        
    }
}

