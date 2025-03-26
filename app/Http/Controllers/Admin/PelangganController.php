<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = User::where('role', 'pelanggan')->get();
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $data = $request->except('foto');
        $data['role'] = 'pelanggan';
        $data['password'] = bcrypt('password123');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('images', 'public');
            $data['foto'] = $fotoPath;
        }

        User::create($data);

        return redirect()->route('admin.pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, User $pelanggan)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $pelanggan->id,
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('images', 'public');
            $data['foto'] = $fotoPath;
        }

        $pelanggan->update($data);

        return redirect()->route('admin.pelanggan')->with('update_success', 'Pelanggan berhasil diperbarui.');
    }

    public function reschedule(Request $request)
    {
        try {
            $request->validate([
                'reservasi_id' => 'required|exists:reservasi,id',
                'tanggal' => 'required|date|after:today',
                'jam_mulai' => 'required',
            ]);

            $reservasi = Reservasi::findOrFail($request->reservasi_id);

            // Check if reschedule is allowed - FIXED VERSION
            // First, get just the date portion from tanggal_reservasi
            $reservationDate = Carbon::parse($reservasi->tanggal_reservasi)->format('Y-m-d');
            // Then combine with jam_mulai to get the correct datetime
            $reservationDateTime = Carbon::parse($reservationDate . ' ' . $reservasi->jadwal->jam_mulai);

            if (now()->gte($reservationDateTime->copy()->subHour())) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak dapat mengubah jadwal kurang dari 1 jam sebelum reservasi'
                ]);
            }

            $savedJadwal = Jadwal::create([
                'id_barberman' => $reservasi->id_barberman,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => Carbon::parse($request->jam_mulai)->addHour()->format('H:i'),
            ]);

            // Update reservation
            $reservasi->tanggal_reservasi = $request->tanggal;
            $reservasi->id_jadwal = $savedJadwal->id;
            $reservasi->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Jadwal reservasi berhasil diubah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }



    public function destroy(User $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan')->with('delete_success', 'Pelanggan berhasil dihapus.');
    }
}
