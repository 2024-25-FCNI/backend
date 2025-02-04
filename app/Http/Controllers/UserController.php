<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    /* try {
        Log::info("Felhasználó törlése: " . $id);

        // Ellenőrizzük, hogy a `user_id` alapján található-e felhasználó
        $user = User::where('user_id', $id)->first();

        if (!$user) {
            return response()->json(['error' => 'Felhasználó nem található'], 404);
        }

        $user->delete();
        Log::info("Felhasználó sikeresen törölve: " . $id);

        return response()->json(['message' => 'Felhasználó sikeresen törölve'], 200);
    } catch (\Exception $e) {
        Log::error("Hiba történt a felhasználó törlésekor: " . $e->getMessage());
        return response()->json(['error' => 'Belső szerverhiba'], 500);
    } */

}


}

