<?php

namespace App\Observers;

use App\Models\VasarlasFej;
use Illuminate\Support\Facades\Log;

class VasarlasObserver
{
    //Új vásárlás létrehozásakor fut le, és logolja az eseményt.
    public function created(VasarlasFej $vasarlas)
    {
        Log::info('Új vásárlás történt: ' . $vasarlas->id);
    }
}
