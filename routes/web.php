<?php

// Middleware
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

//Auth
use App\Http\Controllers\Auth\AuthController;

//Admin
use App\Http\Controllers\Admin\BarbermanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\ReservasiController;



Route::get('/', function () {
    return view('landing-page');
});


//Public Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAll'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPelanggan'])->name('register');

// Admin Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/barberman', [BarbermanController::class, 'index'])->name('admin.barberman');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/admin/layanan', [LayananController::class, 'index'])->name('admin.layanan');
    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran');
    Route::get('/admin/reservasi', [ReservasiController::class, 'index'])->name('admin.reservasi');
});
