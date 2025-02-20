<?php

namespace App\Http\Controllers;

use App\Models\VasarlasFej;
use Illuminate\Http\Request;

class VasarlasFejController extends Controller
{
    
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
        $validated = $request->validate([
            'osszeg' => 'required|integer',
            'datum' => 'required|date',
        ]);

        $vasarlas = VasarlasFej::create($validated);
        return response()->json($vasarlas, 201);
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

// Egy adott felhasználó vásárlásainak lekérdezése ---
public function getVasarlasokByUser($userId) {
    return VasarlasFej::where('user_id', $userId)->get();
}

// Vásárlások összegének kiszámítása egy adott felhasználónál ---
public function getVasarlasOsszeg($userId) {
    return VasarlasFej::where('user_id', $userId)->sum('osszeg');
}


// Vásárlási fej adatok lekérdezése felhasználó adataival együtt ---
public function getVasarlasFejWithUser() {
    return VasarlasFej::with('user')->get();
}

// A legutóbbi vásárlás adatai ---
public function getUtolsoVasarlas() {
    return VasarlasFej::orderBy('created_at', 'desc')->first();
}

}
