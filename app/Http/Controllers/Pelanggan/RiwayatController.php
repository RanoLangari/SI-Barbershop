<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $RiwayatReservasi = Reservasi::where('id_user', Auth::user()->id)->get();
        return view('pelanggan.riwayat.index', compact('RiwayatReservasi'));
    }
}
