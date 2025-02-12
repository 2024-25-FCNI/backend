<?php

namespace App\Http\Controllers;

use App\Models\VasarlasFej;
use Illuminate\Http\Request;

class VasarlasFejController extends Controller
{
    


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
