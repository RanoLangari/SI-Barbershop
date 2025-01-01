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
use App\Http\Controllers\Admin\ProfileController;

//Barberman
use App\Http\Controllers\Barberman\DashboardController as BarbermanDashboardController;
use App\Http\Controllers\Barberman\JadwalController as BarbermanJadwalController;

//Pelanggan
use App\Http\Controllers\Pelanggan\ReservasiController as PelangganReservasiController;


Route::get('/', function () {
    return view('landing-page');
});


//Public Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAll'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPelanggan'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/barberman', [BarbermanController::class, 'index'])->name('admin.barberman');
    Route::post('/admin/barberman', [BarbermanController::class, 'store'])->name('admin.barberman.store');
    Route::put('/admin/barberman/{barberman}', [BarbermanController::class, 'update'])->name('admin.barberman.update');
    Route::delete('/admin/barberman/{barberman}', [BarbermanController::class, 'destroy'])->name('admin.barberman.destroy');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/admin/layanan', [LayananController::class, 'index'])->name('admin.layanan');
    Route::post('/admin/layanan', [LayananController::class, 'store'])->name('admin.layanan.store');
    Route::put('/admin/layanan/{layanan}', [LayananController::class, 'update'])->name('admin.layanan.update');
    Route::delete('/admin/layanan/{layanan}', [LayananController::class, 'destroy'])->name('admin.layanan.destroy');
    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::post('/admin/pelanggan/store', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
    Route::put('/admin/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
    Route::delete('/admin/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');
    Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran');
    Route::get('/admin/reservasi', [ReservasiController::class, 'index'])->name('admin.reservasi');
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
  
  
});



Route::middleware(['auth', 'role:barberman'])->group(function () {

    Route::get('/barberman/dashboard', [BarbermanDashboardController::class, 'index'])->name('barberman.dashboard');
    Route::get('/barberman/jadwal', [BarbermanJadwalController::class, 'index'])->name('barberman.jadwal');
    Route::get('/barberman/profile', [ProfileController::class, 'index'])->name('barberman.profile');
    Route::post('/barberman/profile/update', [ProfileController::class, 'update'])->name('barberman.profile.update');
   

});




Route::middleware(['auth', 'role:pelanggan'])->group(function () {

   
    Route::get('/pelanggan/reservasi',[PelangganReservasiController::class, 'index'])->name('pelanggan.reservasi');

});

