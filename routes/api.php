<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermekController;

use App\Http\Controllers\FizetesController;

Route::post('/send-payment-confirmation', [FizetesController::class, 'sendPaymentConfirmation']);



// Termékek listázása
Route::get('/termekek', [TermekController::class, 'index']);
Route::get('/termekek/{id}', [TermekController::class, 'show']);



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
