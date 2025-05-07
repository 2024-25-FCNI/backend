<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Új jelszó lik kérés
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Elküldjük a jelszó-visszaállító linket ennek a felhasználónak. Miután
        // megpróbáltuk elküldeni a linket, megvizsgáljuk a választ, majd megnézzük,
        // milyen üzenetet kell megjelenítenünk a felhasználónak. Végül elküldjük a megfelelő választ.

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }
}
