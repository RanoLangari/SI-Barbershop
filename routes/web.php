<?php

use App\Http\Controllers\Admin\BarbermanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\ReservasiController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

feat-frontend
Route::get('/', function () {
    return view('landing-page');
});

//Public Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAll'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPelanggan'])->name('register');

// Admin Routes
