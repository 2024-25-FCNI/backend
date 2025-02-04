<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermekController;

use App\Http\Controllers\FizetesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VasarlasTetelController;


Route::get('/vasarlasok-analitika', [VasarlasTetelController::class, 'getVasarlasAnalitika']);
Route::get('/vasarlasok-analitika-idolepes', [VasarlasTetelController::class, 'getBevetelTrend']);


Route::get('/felhasznalok', [UserController::class, 'index']);


Route::post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']);



// Termékek listázása
Route::get('/termekek', [TermekController::class, 'index']);
Route::get('/termekek/{id}', [TermekController::class, 'show']);

Route::delete('/felhasznalok/{id}', [UserController::class, 'destroy']);


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
