<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kategori_layanan;
use App\Models\Layanan;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class ReservasiController extends Controller
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
        try {
            $params = [
                'transaction_details' => [
                    'order_id' => rand(),
                    'gross_amount' => $request->amount,
                ],
                'customer_details' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Save reservation and payment details
            $reservasi = Reservasi::create([
                'kategori_id' => $request->kategori_id,
                'id_layanan' => $request->id_layanan,
                'id_barberman' => $request->id_barberman,
                'id_user' => $request->id_user,
                'id_jadwal' => $request->id_jadwal,
                'tanggal_reservasi' => $request->tanggal_reservasi,
                'status' => 'pending'
            ]);

            Pembayaran::create([
                'transaksi_id' => $params['transaction_details']['order_id'],
                'status' => 'pending',
                'jumlah' => $request->amount,
                'metode_pembayaran' => 'midtrans',
                'tanggal_pembayaran' => now()
            ]);

            return response()->json($snapToken);
        } catch (\Exception $e) {
            Log::error('Error during checkout: ' . $e->getMessage());
            return response()->json(['error' => 'Access denied due to unauthorized transaction, please check client key or server key'], 401);
        }
    }

    public function handlePaymentNotification(Request $request)
    {
        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        $pembayaran = Pembayaran::where('transaksi_id', $orderId)->first();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $pembayaran->status = 'challenge';
                } else {
                    $pembayaran->status = 'success';
                }
            }
        } elseif ($transaction == 'settlement') {
            $pembayaran->status = 'success';
        } elseif ($transaction == 'pending') {
            $pembayaran->status = 'pending';
        } elseif ($transaction == 'deny') {
            $pembayaran->status = 'deny';
        } elseif ($transaction == 'expire') {
            $pembayaran->status = 'expire';
        } elseif ($transaction == 'cancel') {
            $pembayaran->status = 'cancel';
        }

        $pembayaran->save();

        $reservasi = Reservasi::where('id_pembayaran', $pembayaran->id)->first();
        $reservasi->status = $pembayaran->status;
        $reservasi->save();
    }
}
