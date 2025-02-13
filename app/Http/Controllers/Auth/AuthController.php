<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->verified) {
            return response()->json([
                'success' => false,
                'message' => "Email Belum Terverifikasi, Silahkan Cek Kotak Masuk Email Anda atau Spam untuk Verifikasi Email",
            ], 403);
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

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
                'message' => "Email atau Password Salah",
            ], 401);
        }
    }

    public function registerPelanggan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_telepon' => 'required|numeric',
            'alamat' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'pelanggan';
        $validatedData['verified'] = 0;

        $user = User::create($validatedData);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);

        Mail::to($user->email)->send(new VerifyMail($user));

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil, Silahkan Cek Kotak Masuk Email Anda atau Spam untuk Verifikasi Email',
            'redirect' => url('/login')
        ]);
    }

    public function verify($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Email Anda Telah Diverifikasi. Anda Bisa Login Sekarang.";
            } else {
                $status = "Email Anda Sudah Diverifikasi. Anda Bisa Login Sekarang.";
            }
        } else {
            return view('emails.verifiedConfirmMail', [
                'success' => false,
                'message' => "maaf, email tidak dapat diverifikasi.",
            ]);
        }

        return view('emails.verifiedConfirmMail', [
            'success' => true,
            'message' => $status,
            'redirect' => url('/login')
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
