<?php

// Middleware
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

//Auth
use App\Http\Controllers\Auth\AuthController;

//Admin
use App\Http\Controllers\Admin\BarbermanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\ReservasiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Kategori_layanan;
use App\Http\Controllers\Admin\RefundController as AdminRefundController;
//Barberman
use App\Http\Controllers\Barberman\DashboardController as BarbermanDashboardController;
use App\Http\Controllers\Barberman\JadwalController as BarbermanJadwalController;
use App\Http\Controllers\Barberman\ProfileController as BarbermanProfileController;

//Pelanggan
use App\Http\Controllers\Pelanggan\ReservasiController as PelangganReservasiController;
use App\Http\Controllers\Pelanggan\ProfileController as PelangganProfileController;
use App\Http\Controllers\Pelanggan\RefundController as PelangganRefundController;
use App\Http\Controllers\Pelanggan\RiwayatController;
use App\Http\Controllers\RefundController;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/barberman', function () {
    return view('barberman');
})->name('baberman');

Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');



//Public Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAll'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPelanggan'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/user/verify/{token}', [AuthController::class, 'verify'])->name('verify');


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
    Route::get('/admin/kategori_layanan', [Kategori_layanan::class, 'index'])->name('admin.kategori');
    Route::post('/admin/kategori_layanan', [Kategori_layanan::class, 'store'])->name('admin.kategori.store');
    Route::put('/admin/kategori_layanan/{kategori}', [Kategori_layanan::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori_layanan/{kategori}', [Kategori_layanan::class, 'destroy'])->name('admin.kategori.destroy');
    Route::get('/admin/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');
    Route::post('/admin/jadwal', [JadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::put('/admin/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/admin/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('admin.jadwal.destroy');
    Route::get('/admin/refund', [AdminRefundController::class, 'index'])->name('admin.refund');
    Route::put('/admin/refund/{refund}', [AdminRefundController::class, 'update'])->name('admin.refund.update');
    Route::get('/admin/laporan/pdf', [LaporanController::class, 'generatePdf'])->name('admin.laporan.pdf');
});



Route::middleware(['auth', 'role:barberman'])->group(function () {

    Route::get('/barberman/dashboard', [BarbermanDashboardController::class, 'index'])->name('barberman.dashboard');
    Route::get('/barberman/jadwal', [BarbermanJadwalController::class, 'index'])->name('barberman.jadwal');
    Route::get('/barberman/profile', [BarbermanProfileController::class, 'index'])->name('barberman.profile');
    Route::put('/barberman/profile/update', [BarbermanProfileController::class, 'update'])->name('barberman.profile.update');
});




Route::middleware(['auth', 'role:pelanggan'])->group(function () {


    Route::get('/pelanggan/reservasi', [PelangganReservasiController::class, 'index'])->name('pelanggan.reservasi');
    Route::get('/get-layanan-by-kategori/{kategori_id}', [PelangganReservasiController::class, 'getLayananByKategori']);
    Route::get('/get-barberman', [PelangganReservasiController::class, 'getBarberman']);
    Route::get('/get-barberman-schedule/{barbermanId}', [PelangganReservasiController::class, 'getBarbermanSchedule']);
    Route::post('/checkout', [PelangganReservasiController::class, 'checkout'])->name('checkout');
    Route::get('/midtrans/notification', [PelangganReservasiController::class, 'handlePaymentNotification'])->name('midtrans.notification');
    Route::get('/pelanggan/profile', [PelangganProfileController::class, 'index'])->name('pelanggan.profile');
    Route::get('/pelanggan/riwayat', [RiwayatController::class, 'index'])->name('pelanggan.riwayat');
    Route::post('/pelanggan/riwayat/pay/{reservasi}', [RiwayatController::class, 'pay'])->name('pelanggan.riwayat.pay');
    Route::post('/pelanggan/riwayat/cancel/{reservasi}', [RiwayatController::class, 'cancel'])->name('pelanggan.riwayat.cancel');
    Route::post('/pelanggan/riwayat/refund/{reservasi}', [PelangganRefundController::class, 'store'])->name('pelanggan.refund');
    Route::put('/pelanggan/profile/update', [PelangganProfileController::class, 'update'])->name('pelanggan.profile.update');
});
