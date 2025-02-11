<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Refund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefundController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_reservasi' => 'required',
                'id_pembayaran' => 'required',
                'alasan' => 'required',
                'merchant' => 'required',
                'address_refund' => 'required',
                'address_name' => 'required'
            ]);

            $refund = Refund::create([
                'id_reservasi' => $request->id_reservasi,
                'id_pembayaran' => $request->id_pembayaran,
                'alasan' => $request->alasan,
                'status' => 'PENDING',
                'merchant' => $request->merchant,
                'address_refund' => $request->address_refund,
                'address_name' => $request->address_name
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Refund berhasil dibuat',
                'data' => $refund
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
