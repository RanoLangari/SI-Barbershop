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
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->no_telepon = $request->no_telepon;
        $user->alamat = $request->alamat;

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = $request->file('foto')->store('images', 'public');
        }
        $user->save();

        return redirect()->route('barberman.profile')->with('success', 'Profile berhasil diperbarui');
    }
}
