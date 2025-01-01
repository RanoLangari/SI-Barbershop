<?php

namespace App\Http\Controllers\Barberman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        return view('barberman.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $data['foto'] = $request->file('foto')->store('images', 'public');
        }

        try {
            $user->update($data);
            return redirect()->route('barberman.profile')->with('success', 'Profile berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('barberman.profile')->with('error', 'Gagal diperbarui.');
        }
    }
}
