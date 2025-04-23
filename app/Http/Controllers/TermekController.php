<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Termek;
use Illuminate\Support\Facades\Log;

class TermekController extends Controller
{
    public function index()
    {
        $termekek = Termek::all();
        return response()->json($termekek);
    }

    public function show($id)
    {
        try {
            Log::info("Lekérdezett termék ID: " . $id);
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

    public function getLatestTermekek()
    {
        return Termek::orderBy('created_at', 'desc')->limit(5)->get();
    }

    public function getLegdragabbTermek()
    {
        return Termek::orderBy('ar', 'desc')->first();
    }

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
                'hozzaferesi_ido' => 'required|integer',
                'ar' => 'required|integer',
                'jelzes' => 'nullable|string',
                'kep' => 'nullable|image|max:2048',
                'video' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
                'video_existing' => 'nullable|string',
                'cimkek' => 'nullable|string',
            ]);

            if ($request->hasFile('kep')) {
                $validated['kep'] = $request->file('kep')->store('kepek', 'public');
            }

            if ($request->hasFile('video')) {
                $validated['video'] = $request->file('video')->store('videok', 'public');
            } elseif ($request->filled('video_existing')) {
                $validated['video'] = $request->video_existing;
            }

            if ($request->filled('cimkek')) {
                $validated['cimkek'] = json_encode(json_decode($request->cimkek, true));
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
            'video' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'hozzaferesi_ido' => 'integer',
            'ar' => 'integer',
            'jelzes' => 'string',
            'kep' => 'string',
        ]);

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('videok', 'public');
        }

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
