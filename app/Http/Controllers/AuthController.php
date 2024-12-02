<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginAll(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'redirect' => url('/'),
            ]);
            $user = Auth::user();
            $redirectUrl = match ($user->role) {
                'admin' => url('/admin/dashboard'),
                'barberman' => url('/barberman/dashboard'),
                'pelanggan' => url('/'),
                default => url('/'),
            };

            return response()->json([
                'success' => true,
                'redirect' => $redirectUrl,
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => "Wrong Email or Password",
            ], 401);
        }
    }

    public function registerPelanggan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_telp' => 'required|numeric'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'pelanggan';

        User::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'redirect' => url('/')
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
