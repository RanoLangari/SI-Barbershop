<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function destroy(User $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan')->with('delete_success', 'Pelanggan berhasil dihapus.');
    }
}
