<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Route;

// Route Publik
Route::post('/login', [AuthController::class, 'LoginUser']);
Route::post('/register', [AuthController::class, 'RegisterUser']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Route Tabungan
    Route::get('/tabungan', [TabunganController::class, 'index']);
    Route::post('/tabungan', [TabunganController::class, 'store']);
    Route::put('/tabungan/{id_tabungan}', [TabunganController::class, 'update']);
    Route::delete('/tabungan/{id_tabungan}', [TabunganController::class, 'destroy']);
});
