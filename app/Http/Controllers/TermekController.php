<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Termek;

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
        $termek = Termek::find($id);

        if (!$termek) {
            return response()->json(['message' => 'A termék nem található'], 404);
        }

        return response()->json($termek);
    }
}
