<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{   

   /*  public function uploadProfilkep(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Nem vagy bejelentkezve.'], 401);
        }

        if ($request->hasFile('profilkep')) {
            $file = $request->file('profilkep');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/profilkepek', $filename);

            // Felhasználó frissítése
            $user->profilkep = $filename;
            $user->save();

            return response()->json(['message' => 'Profilkép feltöltve.', 'fajlnev' => $filename]);
        }

        return response()->json(['error' => 'Nem küldtél fájlt.'], 400);
    } */


    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hiba történt a felhasználók lekérésekor'], 500);
        }
    }



public function destroy($id)
{
    User::find($id)->delete();
}


}

