<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Termek;
use Illuminate\Support\Facades\Log;

class TermekController extends Controller
{
    /**
     * Termékek lekérdezése.
     */
    public function index()
    {
        // Minden termék lekérdezése az adatbázisból
        $termekek = Termek::all();

        // Válasz JSON formátumban
        return response()->json($termekek);
    }

    public function show($id)
    {
        try {
            Log::info("Lekérdezett termék ID: " . $id); // Debug log

            // Mivel a táblában a kulcs neve 'termek_id', nem 'id', ezért módosítanunk kell a lekérdezést
            $termek = Termek::where('termek_id', $id)->first();

            if (!$termek) {
                return response()->json(['error' => 'A termék nem található!'], 404);
            }

            return response()->json($termek);
        } catch (\Exception $e) {
            Log::error("Hiba a termék lekérdezésekor: " . $e->getMessage());
            return response()->json(['error' => 'Belső szerverhiba'], 500);
        }
    }

    // A legújabb 5 termék lekérdezése
    public function getLatestTermekek()
    {
        return Termek::orderBy('created_at', 'desc')->limit(5)->get();
    }

    // Legdrágább termék lekérdezése
    public function getLegdragabbTermek()
    {
        return Termek::orderBy('ar', 'desc')->first();
    }

    // Adott címkéhez tartozó termékek lekérdezése
    public function getTermekekByCimke($cimkeId)
    {
        return Termek::where('cimke_id', $cimkeId)->get();
    }

    public function store(Request $request)
{
    try {
        Log::info('Új termék mentése megkezdődött.', ['request_data' => $request->all()]);

        // 🔹 VALIDÁCIÓ - Kép fogadása Base64 formátumban is
        $validated = $request->validate([
            'cim' => 'required|string|max:255',
            'leiras' => 'nullable|string',
            'ar' => 'required|integer',
            'hozzaferesi_ido' => 'integer',
            'kep' => 'nullable|string', // 🔥 Base64 képet is engedünk
        ]);

        Log::info('Validáció sikeres.', ['validated_data' => $validated]);

        // 🔹 Kép mentése fájlként, ha Base64-ben érkezik
        if (!empty($validated['kep'])) {
            $imageData = base64_decode($validated['kep']);

            if ($imageData === false) {
                Log::error('Base64 dekódolási hiba.', ['kep' => $validated['kep']]);
                return response()->json(['error' => 'Érvénytelen képformátum'], 400);
            }

            $imageName = uniqid() . '.jpg';
            $imagePath = storage_path('app/public/' . $imageName);

            if (file_put_contents($imagePath, $imageData) === false) {
                Log::error('Kép fájlba mentése sikertelen.', ['path' => $imagePath]);
                return response()->json(['error' => 'Kép mentése sikertelen'], 500);
            }

            $validated['kep'] = 'storage/' . $imageName;
            Log::info('Kép sikeresen mentve.', ['image_path' => $validated['kep']]);
        }

        // 🔹 TERMÉK MENTÉSE
        $termek = Termek::create($validated);
        Log::info('Termék sikeresen mentve.', ['termek' => $termek]);

        return response()->json($termek, 201);
    } catch (\Exception $e) {
        Log::error('Hiba a termék mentésekor.', [
            'error_message' => $e->getMessage(),
            'error_trace' => $e->getTraceAsString()
        ]);

        return response()->json(['error' => 'Belső szerverhiba'], 500);
    }
}


    public function update(Request $request, $id)
    {
        $termek = Termek::findOrFail($id);
        $validated = $request->validate([
            'cim' => 'required|string|max:255',
            'leiras' => 'nullable|string',
            'url' => 'required|string',
            'hozzaferesi_ido' => 'integer',
            'ar' => 'integer',
            'jelzes' => 'string',
            'kep' => 'string',
        ]);
        $termek->update($validated);
        return response()->json($termek);
    }

    public function destroy($id)
    {
        $termek = Termek::find($id);
        
        if (!$termek) {
            return response()->json(['error' => 'A termék nem található!'], 404);
        }

        $termek->delete();
        return response()->json(['message' => 'A termék sikeresen törölve!']);
    }
}
