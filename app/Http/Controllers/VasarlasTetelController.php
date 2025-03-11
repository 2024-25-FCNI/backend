<?php
 
namespace App\Http\Controllers;
 
use App\Models\VasarlasTetel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class VasarlasTetelController extends Controller
{
    public function index()
    {
        return response()->json(VasarlasTetel::all());
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vasarlas_id' => 'required|exists:vasarlas_fejs,vasarlas_id',
            'termek_id' => 'required|exists:termeks,termek_id',
        ]);
 
        $vasarlasTetel = VasarlasTetel::create($validated);
        return response()->json($vasarlasTetel, 201);
    }
 
    public function destroy($vasarlas_id, $termek_id)
    {
        VasarlasTetel::where('vasarlas_id', $vasarlas_id)->where('termek_id', $termek_id)->delete();
        return response()->json(null, 204);
    }
   
 
 
    public function getVasarlasAnalitika(Request $request)
    {
        $kezdodatum = $request->input('kezdodatum');  
        $vegdatum = $request->input('vegdatum');
 
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
 
 
 
 
 
 
 
    // Vásárlási tételek lekérdezése termékekkel együtt
    public function getVasarlasTetelWithTermek()
    {
        return VasarlasTetel::with('termek')->get();
    }
 
    // Vásárlási tételek összegének kiszámítása
    public function getVasarlasTetelOsszeg()
    {
        return VasarlasTetel::join('termeks', 'vasarlas_tetels.termek_id', '=', 'termeks.termek_id')
            ->select(DB::raw('sum(termeks.ar) as total_osszeg'))
            ->first();
    }
}
 