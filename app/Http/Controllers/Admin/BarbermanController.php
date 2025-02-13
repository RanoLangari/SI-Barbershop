<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarbermanController extends Controller
{
    public function index()
    {
        $barberman = User::where('role', 'barberman')->get();
        return view('admin.barberman.index', compact('barberman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        $data = $request->all();
        $data['role'] = 'barberman';
        $data['password'] = bcrypt('password123');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barberman_fotos', 'public');
        }

        try {
            User::create($data);
            return redirect()->route('admin.barberman')->with('success', 'Barberman berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('admin.barberman')->with('error', 'Gagal ditambahkan.');
        }
    }

    public function update(Request $request, User $barberman)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($barberman->foto) {
                Storage::disk('public')->delete($barberman->foto);
            }
            $data['foto'] = $request->file('foto')->store('barberman_fotos', 'public');
        }

        try {
            $barberman->update($data);
            return redirect()->route('admin.barberman')->with('success', 'Barberman berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.barberman')->with('error', 'Gagal diperbarui.');
        }
    }

    public function destroy(User $barberman)
    {
        try {
            $barberman->delete();
            return redirect()->route('admin.barberman')->with('success', 'Barberman berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.barberman')->with('error', 'Gagal dihapus.');
        }
    }
}
