<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VideoAccessController extends Controller
{
    public function generateToken($videoId)
    {
        $userId = Auth::id();
        
        // Ellenőrizzük, hogy a felhasználó megvette-e a videót
        $order = DB::table('vasarlas_tetels')
            ->join('vasarlas_fejs', 'vasarlas_tetels.vasarlas_id', '=', 'vasarlas_fejs.id')
            ->where('vasarlas_fejs.user_id', $userId)
            ->where('vasarlas_tetels.termek_id', $videoId)
            ->exists();
        
        if (!$order) {
            return response()->json(['error' => 'Nincs jogosultság a videóra.'], 403);
        }
        
        $token = Str::random(32);
        $expiresAt = Carbon::now()->addMinutes(30);
        
        DB::table('video_tokens')->insert([
            'user_id' => $userId,
            'termek_id' => $videoId,
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return response()->json(['token' => $token]);
    }
    
    public function getVideoUrl(Request $request)
    {
        $videoId = $request->query('video_id');
        $token = $request->query('token');
        
        $record = DB::table('video_tokens')
            ->where('termek_id', $videoId)
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->first();
        
        if (!$record) {
            return response()->json(['error' => 'Érvénytelen vagy lejárt token.'], 403);
        }
        
        $video = DB::table('termeks')->where('termek_id', $videoId)->first();
        
        if (!$video) {
            return response()->json(['error' => 'Videó nem található'], 404);
        }

        return response()->json([
            'youtube_embed' => "https://www.youtube.com/embed/" . $this->extractYouTubeId($video->url)
        ]);
    }
    
    private function extractYouTubeId($url) {
        if (Str::contains($url, 'youtube.com') || Str::contains($url, 'youtu.be')) {
            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:.*v=|.*\/v\/|.*embed\/|.*watch\?.*v=))([^"&?\/\s]{11})/', $url, $matches);
            return $matches[1] ?? null;
        } elseif (Str::contains($url, 'drive.google.com')) {
            preg_match('/[-\w]{25,}/', $url, $matches);
            return $matches[0] ?? null;
        }
        return null;        
    }
}
