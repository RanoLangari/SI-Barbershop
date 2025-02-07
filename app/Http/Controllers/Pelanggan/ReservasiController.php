<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Mail\SendInvoices;
use App\Models\Jadwal;
use App\Models\Kategori_layanan;
use App\Models\Layanan;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $Jadwal = Jadwal::with('barberman')->get();
        return view('pelanggan.reservasi.index', compact('Barberman', 'Kategori', 'Layanan', 'Jadwal'));
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

    public function getBarbermanSchedule(Request $request, $barbermanId)
    {
        $jadwal = Jadwal::where('id_barberman', $barbermanId)
            ->where('tanggal', $request->tanggal)
            ->get(['jam_mulai', 'jam_selesai']);

        // Get all possible time slots (9:00 - 21:00) with 2-hour intervals
        $allTimeSlots = [];
        for ($hour = 9; $hour < 21; $hour += 2) {
            $timeSlot = sprintf("%02d:00", $hour);
            $allTimeSlots[$timeSlot] = true;
        }

        // Mark booked slots as unavailable
        foreach ($jadwal as $j) {
            $start = Carbon::parse($j->jam_mulai)->format('H:i');
            $allTimeSlots[$start] = false;
        }

        // Convert to array format for response
        $availableSlots = [];
        foreach ($allTimeSlots as $time => $available) {
            $availableSlots[] = [
                'time' => $time,
                'available' => $available
            ];
        }

        return response()->json($availableSlots);
    }

    public function checkout(Request $request)
    {
        try {
            if (empty(Config::$serverKey) || empty(Config::$clientKey)) {
                throw new \Exception('Midtrans configuration keys are not set.');
            }

            $orderId = 'TRX' . time();

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => Layanan::find($request->id_layanan)->harga,
                ],
                'customer_details' => [
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'phone'      => $request->phone,
                ],
            ];

            // dd([
            //     'params' => $params,
            //     'request' => $request->all(),
            // ]);
            $jadwal = Jadwal::create([
                'id_barberman' => $request->id_barberman,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->id_jadwal, // The time string "13:00"
                'jam_selesai' => Carbon::parse($request->id_jadwal)->addHour()->format('H:i') // Add 1 hour to end time
            ]);
            // Create payment record
            $pembayaran = Pembayaran::create([
                'transaksi_id'      => $params['transaction_details']['order_id'],
                'status'            => 'pending',
                'jumlah'            => Layanan::find($request->id_layanan)->harga,
                'metode_pembayaran' => 'midtrans',
                'tanggal_pembayaran' => now()
            ]);

            // Then create the reservation with the jadwal ID
            $reservasi = Reservasi::create([
                'kategori_id' => Layanan::find($request->id_layanan)->kategori_id,
                'id_layanan' => $request->id_layanan,
                'id_barberman' => $request->id_barberman,
                'id_user' => $request->id_user,
                'id_jadwal' => $jadwal->id, // Use the actual jadwal ID
                'id_pembayaran' => $pembayaran->id,
                'tanggal_reservasi' => $request->tanggal,
                'status' => 'pending'
            ]);


            // Link payment to reservation
            $reservasi->update(['id_pembayaran' => $pembayaran->id]);

            $snapToken = Snap::getSnapToken($params);
            // dd($snapToken);

            // Save reservation and payment details
            // $reservasi = Reservasi::create([
            //     'kategori_id' => $request->kategori_id,
            //     'id_layanan' => $request->id_layanan,
            //     'id_barberman' => $request->id_barberman,
            //     'id_user' => $request->id_user,
            //     'id_jadwal' => $request->id_jadwal,
            //     'tanggal_reservasi' => $request->tanggal_reservasi,
            //     'status' => 'pending'
            // ]);

            // Pembayaran::create([
            //     'transaksi_id' => $params['transaction_details']['order_id'],
            //     'status' => 'pending',
            //     'jumlah' => $request->amount,
            //     'metode_pembayaran' => 'midtrans',
            //     'tanggal_pembayaran' => now()
            // ]);

            $reservasi = Reservasi::where('id', $reservasi->id)->with('kategori_layanan', 'layanan', 'barberman', 'user', 'jadwal', 'pembayaran')->first();

            Mail::to($reservasi->user->email)->send(new SendInvoices($reservasi));
            return response()->json(['snapToken' => $snapToken, 'OrderId' => $orderId]);
        } catch (\Exception $e) {
            Log::error('Error during checkout: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
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
