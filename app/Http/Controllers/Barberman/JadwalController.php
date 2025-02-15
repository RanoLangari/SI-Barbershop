<?php

namespace App\Http\Controllers\Barberman;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\Reservasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $barbermanId = Auth::id();
        $jadwal = Jadwal::where('id_barberman', $barbermanId)
            ->with(['reservasi' => function ($query) {
                $query->with('user', 'layanan');
            }])
            ->get();

        return view('barberman.jadwal.index', compact('jadwal'));
    }
}
