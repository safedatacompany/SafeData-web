<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    // logout route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'checkLogin'])->name('login');

    // Route::get('/register', function () {
    //     return Inertia::render('Auth/Register');
    // })->name('register');
});
