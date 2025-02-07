<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $dataBarberman = User::where('role', 'barberman')->get();
        $dataJadwal = Jadwal::with('barberman')->get();
        return view('admin.jadwal.index', compact('dataJadwal', 'dataBarberman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barberman' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create([
            'id_barberman' => $request->id_barberman,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil ditambahkan');
    }


    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'id_barberman' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal->update([
            'id_barberman' => $request->id_barberman,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil diubah');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil dihapus');
    }
}
