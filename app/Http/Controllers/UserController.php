<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
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

    public function uploadProfilkep(Request $request)
    {
        $request->validate([
            'profilkep' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Nem vagy bejelentkezve.'], 401);
        }

        $file = $request->file('profilkep');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('profilkep'), $filename); // kép mentése

        // közvetlen frissítés
        DB::table('users')->where('id', $user->id)->update([
            'profilkep' => $filename,
            'updated_at' => now(),
        ]);

        return response()->json(['profilkep' => $filename]);
    }
}
