<?php

use App\Http\Controllers\CimkeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermekController;

use App\Http\Controllers\FizetesController;
use App\Http\Controllers\KapcsoloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VasarlasFejController;
use App\Http\Controllers\VasarlasTetelController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware(['auth:sanctum', 'admin'])->post('/termekek', [TermekController::class, 'store']);



Route::middleware('web')->group(function () {
    Route::get('/sanctum/csrf-cookie', function (Request $request) {
        return response()->json(['message' => 'CSRF cookie set']);
    });
});




Route::middleware('auth:sanctum')->get('/ellenoriz-vasarlas/{termekId}', [VasarlasFejController::class, 'ellenorizVasarlas']);



Route::post('/termekek', [TermekController::class, 'store']);


Route::post('/forgot-password', [AuthenticatedSessionController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthenticatedSessionController::class, 'resetPassword']);


Route::middleware([EnsureFrontendRequestsAreStateful::class, 'auth:sanctum'])
    ->post('/vasarlas', [VasarlasFejController::class, 'store']);


Route::middleware(['auth:sanctum'])->post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']);
//Route::get('/send-mail', [MailController::class, 'sendTestMail']);
 
//Route::get('send_mail', [MailController::class, 'index']);
/* Route::post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']);
 */
/* Route::post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']); 
//middleware([EnsureFrontendRequestsAreStateful::class, 'auth:sanctum']-> */



Route::get('/vasarlasok-analitika', [VasarlasTetelController::class, 'getVasarlasAnalitika']);

Route::get('/vasarlasok-analitika-idolepes', [VasarlasTetelController::class, 'getBevetelTrend']);


Route::get('/felhasznalok', [UserController::class, 'index']);





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
    //Route::delete('/termekek/{termek_id}', [TermekController::class, 'destroy']);
});

Route::post('/kapcsolo', [KapcsoloController::class, 'store']);

//ALAPFUGGVENYEK
// 🌟 Címkék (cimkes)
Route::get('/cimkek', [CimkeController::class, 'index']);          // Minden címke lekérdezése
Route::get('/cimkek/{id}', [CimkeController::class, 'show']);       // Egy címke lekérdezése
Route::post('/cimkek', [CimkeController::class, 'store']);         // Új címke létrehozása
Route::put('/cimkek/{id}', [CimkeController::class, 'update']);    // Címke módosítása
Route::delete('/cimkek/{id}', [CimkeController::class, 'destroy']); // Címke törlése

// 🌟 Kapcsolók (kapcsolos) - Termékek és címkék összekapcsolása
Route::get('/kapcsolok', [KapcsoloController::class, 'index']);   // Minden kapcsolat lekérdezése
Route::post('/kapcsolok', [KapcsoloController::class, 'store']);  // Új kapcsolat létrehozása
Route::delete('/kapcsolok/{termek_id}/{cimke_id}', [KapcsoloController::class, 'destroy']); // Kapcsolat törlése

// 🌟 Termékek (termeks)
Route::get('/termekek/{id}', [TermekController::class, 'show']);       // Egy termék lekérdezése
Route::post('/termekek', [TermekController::class, 'store']);         // Új termék létrehozása
Route::delete('/termekek/{termek_id}', [TermekController::class, 'destroy']);


// 🌟 Vásárlások Fejlécei (vasarlas_fejs)
Route::get('/vasarlasok', [VasarlasFejController::class, 'index']);    // Minden vásárlás lekérdezése
Route::get('/vasarlasok/{id}', [VasarlasFejController::class, 'show']); // Egy vásárlás lekérdezése
Route::post('/vasarlasok', [VasarlasFejController::class, 'store']);   // Új vásárlás létrehozása
Route::put('/vasarlasok/{id}', [VasarlasFejController::class, 'update']); // Vásárlás módosítása
Route::delete('/vasarlasok/{id}', [VasarlasFejController::class, 'destroy']); // Vásárlás törlése

// 🌟 Vásárlások Tételei (vasarlas_tetels)
Route::get('/vasarlas_tetelek', [VasarlasTetelController::class, 'index']);   // Minden vásárlási tétel lekérdezése
Route::post('/vasarlas_tetelek', [VasarlasTetelController::class, 'store']);  // Új vásárlási tétel hozzáadása
Route::delete('/vasarlas_tetelek/{vasarlas_id}/{termek_id}', [VasarlasTetelController::class, 'destroy']); // Vásárlási tétel törlése
