<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Route;

// Route Publik
Route::post('/login', [AuthController::class, 'LoginUser']);
Route::post('/register', [AuthController::class, 'RegisterUser']);

Route::middleware(['auth:sanctum'])->group(function () {
    //
});
