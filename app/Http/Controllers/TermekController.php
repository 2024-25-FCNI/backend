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
        $validated = $request->validate([
            'cim' => 'required|string|max:255',
            'bemutatas' => 'nullable|string',
            'leiras' => 'nullable|string',
            'url' => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg|max:51200',
            'hozzaferesi_ido' => 'required|integer',
            'ar' => 'required|integer',
            'jelzes' => 'nullable|string',
            'kep' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('kep')) {
            $kep = $request->file('kep');
            $kepNev = time() . '_' . $kep->getClientOriginalName();
            $kep->move(public_path('kepek'), $kepNev); // ⬅️ ide kerül a public/kepek mappába
            $validated['kep'] = $kepNev;
        }
        

        if ($request->hasFile('url')) {
            $video = $request->file('url');
            $videoNev = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('videok'), $videoNev);
            $validated['url'] = $videoNev;
        }

        $termek = Termek::create($validated);

        return response()->json($termek, 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    }
}


    

    public function update(Request $request, $id)
    {
        $termek = Termek::findOrFail($id);
        $validated = $request->validate([
            'cim' => 'required|string|max:255',
            'bemutatas' => 'nullable|string',
            'leiras' => 'nullable|string',
            'url' => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg|max:51200',
            'hozzaferesi_ido' => 'integer',
            'ar' => 'integer',
            'jelzes' => 'string',
            'kep' => 'string',
        ]);
        $termek->update($validated);
        return response()->json($termek);
    }

    public function destroy($termek_id)
{
    $termek = Termek::where('termek_id', $termek_id)->first();

    if (!$termek) {
        return response()->json(['error' => 'A termék nem található!'], 404);
    }

    $termek->delete();

    return response()->json(['message' => 'A termék sikeresen törölve!']);
}

    
}
