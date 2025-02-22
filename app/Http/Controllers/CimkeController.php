<?php

namespace App\Http\Controllers;

use App\Models\Cimke;
use Illuminate\Http\Request;

class CimkeController extends Controller
{
    public function index()
    {
        return response()->json(Cimke::all());
    }

    public function show($id)
    {
        return response()->json(Cimke::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['elnevezes' => 'required|string|max:255']);
        $cimke = Cimke::create($validated);
        return response()->json($cimke, 201);
    }

    public function update(Request $request, $id)
    {
        $cimke = Cimke::findOrFail($id);
        $validated = $request->validate(['elnevezes' => 'required|string|max:255']);
        $cimke->update($validated);
        return response()->json($cimke);
    }

    public function destroy($id)
    {
        Cimke::destroy($id);
        return response()->json(null, 204);
    }
}
