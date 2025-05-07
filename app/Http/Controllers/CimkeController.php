<?php

namespace App\Http\Controllers;

use App\Models\Cimke;
use Illuminate\Http\Request;

class CimkeController extends Controller
{
    public function index()
    {
        $cimkek = Cimke::pluck('elnevezes');
        return response()->json($cimkek);
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
