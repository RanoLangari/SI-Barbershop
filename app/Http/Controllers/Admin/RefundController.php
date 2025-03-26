<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Refund;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $dataRefund = Refund::with('reservasi', 'pembayaran')->get();
        return view('admin.refund.index', compact('dataRefund'));
    }

    public function update(Request $request, $id)
    {
        try {
            $refund = Refund::findOrFail($id);
            $refund->status = $request->status;
            if ($refund->status == 'success') {
                if (!$request->hasFile('bukti')) {
                    return response()->json(['error' => 'Bukti refund harus diunggah'], 422);
                }
            }
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move('uploads/refund', $filename);
                $refund->bukti = $filename;
            }

            $refund->save();

            // hapus jadwal
            if ($refund->status == 'success') {
                $reservasi = Reservasi::findOrFail($refund->id_reservasi);
                $idJadwal = $reservasi->id_jadwal;
                $jadwal = Jadwal::findOrFail($idJadwal);
                $jadwal->status = false;
                $jadwal->save();
            } else {
                $reservasi = Reservasi::findOrFail($refund->id_reservasi);
                $idJadwal = $reservasi->id_jadwal;
                $jadwal = Jadwal::findOrFail($idJadwal);
                $jadwal->status = true;
                $jadwal->save();
            }

            return response()->json(['message' => 'Refund berhasil diupdate'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
