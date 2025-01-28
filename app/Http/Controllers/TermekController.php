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
    
}
