<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kategori_layanan;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class ReservasiController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        $Barberman = User::where('role', 'barberman')->get();
        $Kategori = Kategori_layanan::all();
        $Layanan = Layanan::with('kategori')->get();
        return view('pelanggan.reservasi.index', compact('Barberman', 'Kategori', 'Layanan'));
    }

    public function getLayananByKategori(Request $request)
    {
        $layanan = Layanan::where('kategori_id', $request->kategori_id)->get();
        return response()->json($layanan);
    }

    public function getBarberman()
    {
        $barberman = User::where('role', 'barberman')
            ->select('id', 'name', 'foto', 'no_telepon')
            ->get();
        return response()->json($barberman);
    }

    public function checkout(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'test',
                'phone' => 'test',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        dd($snapToken);
        return response()->json($snapToken);
    }
}
