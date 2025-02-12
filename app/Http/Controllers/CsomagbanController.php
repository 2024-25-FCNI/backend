<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CsomagbanController extends Controller
{
    // --- 9. Egy adott csomagban található termékek lekérdezése ---
    public function getCsomagbanTermekek($csomagId)
    {
        return DB::table('csomagbans')
            ->join('termeks', 'csomagbans.termek_id', '=', 'termeks.termek_id')
            ->where('csomagbans.csomag_id', $csomagId)
            ->get();
    }
}
