<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RiwayatTabunganController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TransaksiTabunganController;
use Illuminate\Support\Facades\Route;

// Route Publik
Route::post('/login', [AuthController::class, 'LoginUser']);
Route::post('/register', [AuthController::class, 'RegisterUser']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'LogoutUser']);

    // Route Tabungan
    Route::get('/tabungan', [TabunganController::class, 'index']);
    Route::post('/tabungan', [TabunganController::class, 'store']);
    Route::put('/tabungan/{id_tabungan}', [TabunganController::class, 'update']);
    Route::delete('/tabungan/{id_tabungan}', [TabunganController::class, 'destroy']);

    // Route Riwayat Tabungan
    Route::get('/riwayat-tabungan', [TransaksiTabunganController::class, 'index']);
    Route::post('/riwayat-tabungan', [TransaksiTabunganController::class, 'store']);
});
