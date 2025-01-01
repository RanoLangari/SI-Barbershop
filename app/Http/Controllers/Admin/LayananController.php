<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
        ]);

        try {
            Layanan::create($request->all());
            return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('admin.layanan')->with('error', 'Gagal menambahkan layanan.');
        }
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
        ]);

        try {
            $layanan->update($request->all());
            return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.layanan')->with('error', 'Gagal memperbarui layanan.');
        }
    }

    public function destroy(Layanan $layanan)
    {
        try {
            $layanan->delete();
            return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.layanan')->with('error', 'Gagal menghapus layanan.');
        }
    }
}
