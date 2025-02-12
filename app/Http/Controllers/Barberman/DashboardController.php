<?php

namespace App\Http\Controllers\Barberman;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Reservasi; // Add this line
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pelangganCount = User::where('role', 'pelanggan')->count();
        $barbermanCount = User::where('role', 'barberman')->count();

        $totalReservasi = Reservasi::count(); // Add this line

        $totalPendapatan = Pembayaran::sum('jumlah');
        $pendapatanPerTahun = Pembayaran::whereYear('tanggal_pembayaran', date('Y'))->sum('jumlah');
        $pendapatanPerBulan = Pembayaran::whereMonth('tanggal_pembayaran', date('m'))->sum('jumlah');
        $pendapatanPerHari = Pembayaran::whereDay('tanggal_pembayaran', date('d'))->sum('jumlah');

        return view('barberman.dashboard.index')
            ->with('pelangganCount', $pelangganCount)
            ->with('barbermanCount', $barbermanCount)
            ->with('totalReservasi', $totalReservasi) // Add this line
            ->with('totalPendapatan', $totalPendapatan)
            ->with('pendapatanPerTahun', $pendapatanPerTahun)
            ->with('pendapatanPerBulan', $pendapatanPerBulan)
            ->with('pendapatanPerHari', $pendapatanPerHari);
    }
}
