<?php

namespace App\Http\Controllers\Barberman;

use App\Models\Jadwal;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $dataPelanggan = User::where('role', 'pelanggan')->get(); // Correct role for customers
        $dataJadwal = Jadwal::with(['barberman', 'reservasi.user'])->get();

        // Ensure the customer names are correctly added to the schedule
        foreach ($dataJadwal as $jadwal) {
            $jadwal->customer_name = optional($jadwal->reservasi)->user->name ?? '';
        }

        return view('barberman.jadwal.index', compact('dataJadwal', 'dataPelanggan'))
            ->with('jadwal', $dataJadwal); // Pass the correct variable name
    }
}
