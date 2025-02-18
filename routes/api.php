<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermekController;

use App\Http\Controllers\FizetesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VasarlasFejController;
use App\Http\Controllers\VasarlasTetelController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::get('/vasarlasok-analitika', [VasarlasTetelController::class, 'getVasarlasAnalitika']);

Route::get('/vasarlasok-analitika-idolepes', [VasarlasTetelController::class, 'getBevetelTrend']);


Route::get('/felhasznalok', [UserController::class, 'index']);

/* Route::post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']);
 */
Route::middleware([EnsureFrontendRequestsAreStateful::class, 'auth:sanctum'])
    ->post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']);

Route::get('/termekek', [TermekController::class, 'index']);
Route::get('/termekek/{id}', [TermekController::class, 'show']);

Route::delete('/felhasznalok/{id}', [UserController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});




// Publikus végpontok
Route::get('/termekek/legujabb', [TermekController::class, 'getLatestTermekek']);
Route::get('/termekek/legdragabb', [TermekController::class, 'getLegdragabbTermek']);
Route::get('/termekek/cimke/{cimkeId}', [TermekController::class, 'getTermekekByCimke']);

// Authenticated felhasználók számára elérhető végpontok (bejelentkezett user)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/vasarlasok/{userId}', [VasarlasFejController::class, 'getVasarlasokByUser'])
        ->middleware('can:view,userId');
    Route::get('/vasarlasok/osszeg/{userId}', [VasarlasFejController::class, 'getVasarlasOsszeg'])
        ->middleware('can:view,userId');
});

// Admin jogosultságot igénylő végpontok
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/vasarlasok/tetelek', [VasarlasTetelController::class, 'getVasarlasTetelWithTermek']);
    Route::get('/vasarlasok/fejek', [VasarlasFejController::class, 'getVasarlasFejWithUser']);
    Route::get('/vasarlasok/utolso', [VasarlasFejController::class, 'getUtolsoVasarlas']);
    Route::get('/vasarlasok/tetelek/osszeg', [VasarlasTetelController::class, 'getVasarlasTetelOsszeg']);
});