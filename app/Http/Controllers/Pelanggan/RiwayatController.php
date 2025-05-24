<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class RiwayatController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        $RiwayatReservasi = Reservasi::where('id_user', Auth::user()->id)
            ->with(['kategori', 'layanan', 'barberman', 'jadwal', 'pembayaran'])
            ->get();
        $Refund = Refund::whereIn('id_reservasi', $RiwayatReservasi->pluck('id'))
            ->with(['reservasi', 'pembayaran'])
            ->get();
        return view('pelanggan.riwayat.index', compact('RiwayatReservasi', 'Refund'));
    }

    public function pay(Reservasi $reservasi)
    {
        $newOrderId = 'TRX' . time();
        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $newOrderId,
                    'gross_amount' => $reservasi->pembayaran->jumlah,
                ],
                'customer_details' => [
                    'name' => $reservasi->user->name,
                    'email' => $reservasi->user->email,
                    'phone' => $reservasi->user->no_telepon,
                ],
            ];

            $reservasi->pembayaran->update(['transaksi_id' => $newOrderId]);
            $reservasi->update(['status' => 'pending']);
            $reservasi->pembayaran->save();
            $reservasi->save();

            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cancel(Reservasi $reservasi)
    {
        try {
            if ($reservasi->pembayaran) {
                $reservasi->pembayaran->delete();
            }

            if ($reservasi->jadwal) {
                $reservasi->jadwal->delete();
            }

            $reservasi->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function refund(Request $request, Reservasi $reservasi)
    {
        try {
            // Validate request
            $request->validate([
                'id_reservasi' => 'required',
                'id_pembayaran' => 'required',
                'alasan' => 'required',
                'merchant' => 'required',
                'address_refund' => 'required',
                'address_name' => 'required',
            ]);

            // Create refund record
            $refund = new Refund();
            $refund->id_reservasi = $request->id_reservasi;
            $refund->id_pembayaran = $request->id_pembayaran;
            $refund->alasan = $request->alasan;
            $refund->merchant = $request->merchant;
            $refund->address_refund = $request->address_refund;
            $refund->address_name = $request->address_name;
            $refund->status = 'pending';
            $refund->save();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}