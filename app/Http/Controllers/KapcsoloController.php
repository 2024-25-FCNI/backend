<?php

namespace App\Http\Controllers;

use App\Models\Kapcsolo;
use Illuminate\Http\Request;

class KapcsoloController extends Controller
{
    public function index()
    {
        return response()->json(Kapcsolo::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'termek_id' => 'required|exists:termeks,termek_id',
            'cimke_id' => 'required|exists:cimkes,cimke_id',
        ]);

        $kapcsolo = Kapcsolo::create($validated);
        return response()->json($kapcsolo, 201);
    }

    public function destroy($termek_id, $cimke_id)
    {
        Kapcsolo::where('termek_id', $termek_id)->where('cimke_id', $cimke_id)->delete();
        return response()->json(null, 204);
    }
}
