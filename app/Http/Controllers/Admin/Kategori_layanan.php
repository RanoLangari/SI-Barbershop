<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori_layanan as KategoriLayananModel;
use Illuminate\Support\Facades\Storage;


class Kategori_layanan extends Controller
{
    public function index()
    {
        $kategori = KategoriLayananModel::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        try {
            $kategori = new \App\Models\Kategori_layanan();
            $kategori->nama = $request->nama;
            $kategori->deskripsi = $request->deskripsi;
            $kategori->gambar = $request->file('gambar')->store('images', 'public');
            $kategori->save();
            return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori')->with('error', 'Gagal menambahkan kategori.');
        }
    }

    public function update (Request $request, KategoriLayananModel $kategori)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        try {
            $kategori->nama = $request->nama;
            $kategori->deskripsi = $request->deskripsi;
            if ($request->hasFile('gambar')) {
                if ($kategori->gambar) {
                    Storage::disk('public')->delete($kategori->gambar);
                }
                $kategori->gambar = $request->file('gambar')->store('images', 'public');
            }
            $kategori->save();
            return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori')->with('error', 'Gagal memperbarui kategori.');
        }
    }

    public function destroy(KategoriLayananModel $kategori)
    {
        try {
            $kategori->delete();
            return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori')->with('error', 'Gagal menghapus kategori.');
        }
    }

    public function landingPage()
    {
        $kategori = KategoriLayananModel::all();
        return view('landing-page', compact('kategori'));
    }

}
