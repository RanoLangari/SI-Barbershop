<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF; // Make sure to install the barryvdh/laravel-dompdf package

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservasi::with('kategori_layanan', 'layanan', 'barberman', 'user', 'jadwal', 'pembayaran')
            ->orderBy('tanggal_reservasi', 'desc');

        $minDate = $request->minDate;
        $maxDate = $request->maxDate;

        if ($request->has('minDate') && $request->has('maxDate')) {
            $query->whereBetween('tanggal_reservasi', [$request->minDate, $request->maxDate]);
        }

        $reservasi = $query->get();

        return view('admin.laporan.index', compact('reservasi', 'minDate', 'maxDate'));
    }

    public function generatePdf(Request $request)
    {
        $query = Reservasi::with('kategori_layanan', 'layanan', 'barberman', 'user', 'jadwal', 'pembayaran')
            ->orderBy('tanggal_reservasi', 'desc');

        $minDate = $request->minDate;
        $maxDate = $request->maxDate;

        if ($request->has('minDate') && $request->has('maxDate')) {
            $query->whereBetween('tanggal_reservasi', [$request->minDate, $request->maxDate]);
        }

        $reservasi = $query->get();
        $pdf = PDF::loadView('admin.laporan.pdf', compact('reservasi', 'minDate', 'maxDate'));
        return $pdf->download('laporan_keuangan.pdf');
    }
}
