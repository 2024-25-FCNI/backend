<?php

namespace App\Http\Controllers;

use App\Models\VasarlasFej;
use App\Models\VasarlasTetel;
use App\Models\Termek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VasarlasFejController extends Controller
{
    public function ellenorizVasarlas($termekId)
    {
        $user = Auth::user();

        // 🔹 Megkeressük a vásárlás fejlécét, hogy a user valóban megvette-e a terméket
        $vasarolt = VasarlasTetel::where('user_id', $user->id)
            ->where('termek_id', $termekId)
            ->where('lejarat_datum', '>', now()) // Hozzáférési idő még nem járt le
            ->exists();

        return response()->json(['megvette' => $vasarolt]);
    }

    public function index()
    {
        return response()->json(VasarlasFej::all());
    }

    public function show($id)
    {
        return response()->json(VasarlasFej::findOrFail($id));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $termek = Termek::findOrFail($request->termek_id);

        // Ellenőrizzük, hogy a felhasználó már megvette-e és még aktív-e
        $existingPurchase = VasarlasTetel::whereHas('vasarlas', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('termek_id', $termek->id)
            ->where('lejarat_datum', '>', now())
            ->exists();

        if ($existingPurchase) {
            return response()->json(['message' => 'Már rendelkezel ezzel a termékkel.'], 409);
        }

        // Vásárlás mentése (fejléc)
        $vasarlas = VasarlasFej::create([
            'user_id' => $user->id,
            'osszeg' => $termek->ar,
            'datum' => now()
        ]);

        // Vásárlási tétel rögzítése (lejárati idővel)
        VasarlasTetel::create([
            'vasarlas_id' => $vasarlas->id,
            'termek_id' => $termek->id,
            'lejarat_datum' => now()->addDays($termek->hozzaferesi_ido)
        ]);

        return response()->json([
            'message' => 'Sikeres vásárlás!',
            'expires_at' => now()->addDays($termek->hozzaferesi_ido)
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $vasarlas = VasarlasFej::findOrFail($id);
        $validated = $request->validate([
            'osszeg' => 'required|integer',
            'datum' => 'required|date',
        ]);
        $vasarlas->update($validated);
        return response()->json($vasarlas);
    }

    public function destroy($id)
    {
        VasarlasFej::destroy($id);
        return response()->json(null, 204);
    }

    // Egy adott felhasználó vásárlásainak lekérdezése
    public function getVasarlasokByUser($userId)
    {
        return VasarlasFej::where('user_id', $userId)->get();
    }

    // Vásárlások összegének kiszámítása egy adott felhasználónál
    public function getVasarlasOsszeg($userId)
    {
        return VasarlasFej::where('user_id', $userId)->sum('osszeg');
    }

    // Vásárlási fej adatok lekérdezése felhasználó adataival együtt
    public function getVasarlasFejWithUser()
    {
        return VasarlasFej::with('user')->get();
    }

    // A legutóbbi vásárlás adatai
    public function getUtolsoVasarlas()
    {
        return VasarlasFej::orderBy('created_at', 'desc')->first();
    }
}
