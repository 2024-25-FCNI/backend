<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Termek;
use App\Models\VasarlasTetel;

class VasarlasTetelController extends Controller
{
    public function getVasarlasAnalitika()
    {
        $termekek = DB::table('termeks')
            ->leftJoin('vasarlas_tetels', 'termeks.termek_id', '=', 'vasarlas_tetels.termek_id')
            ->select(
                'termeks.termek_id',
                'termeks.cim',
                'termeks.ar',
                DB::raw('COUNT(vasarlas_tetels.termek_id) as darabszam'),
                DB::raw('SUM(vasarlas_tetels.termek_id * termeks.ar) as osszBevetel')
            )
            ->groupBy('termeks.termek_id', 'termeks.cim', 'termeks.ar')
            ->get();

        return response()->json($termekek);
    }
}
