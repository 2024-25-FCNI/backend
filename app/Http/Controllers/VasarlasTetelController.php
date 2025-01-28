<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VasarlasTetelController extends Controller
{
    public function getVasarlasAnalitika(Request $request)
{
    $kezdodatum = $request->input('kezdodatum'); // Pl.: 2024-01-01
    $vegdatum = $request->input('vegdatum'); // Pl.: 2024-12-31

    $query = DB::table('termeks')
        ->leftJoin('vasarlas_tetels', 'termeks.termek_id', '=', 'vasarlas_tetels.termek_id')
        ->leftJoin('vasarlas_fejs', 'vasarlas_tetels.vasarlas_id', '=', 'vasarlas_fejs.vasarlas_id')
        ->select(
            'termeks.termek_id',
            'termeks.cim',
            'termeks.ar',
            DB::raw('COUNT(vasarlas_tetels.termek_id) as darabszam'),
            DB::raw('SUM(vasarlas_tetels.termek_id * termeks.ar) as osszBevetel')
        )
        ->groupBy('termeks.termek_id', 'termeks.cim', 'termeks.ar');

    // Ha van dátumszűrés, akkor alkalmazzuk
    if ($kezdodatum && $vegdatum) {
        $query->whereBetween('vasarlas_fejs.created_at', [$kezdodatum, $vegdatum]);
    }

    $termekek = $query->get();
    return response()->json($termekek);
}
}
