<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Models\Kategori_layanan;
use Illuminate\Support\Facades\Log;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        $kategori = Kategori_layanan::all();
        return view('admin.layanan.index', compact('layanan', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'kategori_id' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('images', 'public');
            }

            Layanan::create($data);
            return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error adding layanan: ' . $e->getMessage());
            return redirect()->route('admin.layanan')->with('error', 'Gagal menambahkan layanan.');
        }
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'kategori_id' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('images', 'public');
            }

            $layanan->update($data);
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
