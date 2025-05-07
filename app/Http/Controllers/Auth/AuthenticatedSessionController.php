<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    //Kezeli egy bejövő hitelesítési kérelmet

    public function store(LoginRequest $request): HttpResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent(HttpResponse::HTTP_NO_CONTENT);
    }


    // Hitelesített munkamenet megszüntetése

    public function destroy(Request $request): HttpResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent(HttpResponse::HTTP_NO_CONTENT);
    }

    /**
     * Jelszó-visszaállítási email küldése.
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Felhasználó nem található.'], 404);
        }

        // Egyedi token generálása
        $token = Str::random(60);

        // Küldjük az emailt
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return response()->json(['message' => 'Ha az e-mail szerepel a rendszerünkben, küldtünk egy visszaállítási linket.']);
    }

    /**
     * Új jelszó beállítása a visszaállítási tokennel.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Felhasználó nem található.'], 404);
        }

        // Jelszó frissítése
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Sikeres jelszócsere! Most jelentkezz be.'], 200);
    }
}
