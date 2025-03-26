<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function submitUlasan(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id',
            'id_user' => 'required|exists:users,id',
            'ulasan' => 'required|string'
        ]);

        try {
            // Create a new review
            $ulasan = Ulasan::create([
                'id_reservasi' => $request->id_reservasi,
                'id_user' => $request->id_user,
                'ulasan' => $request->ulasan
                // Laravel will auto-fill created_at timestamp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil disimpan',
                'data' => $ulasan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan ulasan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all reviews
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUlasan()
    {
        try {
            $ulasan = Ulasan::with(['user', 'reservasi'])->get();

            // Transform data to include full photo URL and user name
            $ulasan = $ulasan->map(function ($item) {
                if ($item->user) {
                    // Add user name
                    $item->nama_user = $item->user->name;

                    // Add photo URL if available
                    if ($item->user->foto) {
                        $item->user->foto_url = asset('storage/' . $item->user->foto);
                    }
                }
                return $item;
            });

            return response()->json([
                'success' => true,
                'data' => $ulasan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data ulasan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a review
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUlasan($id)
    {
        try {
            $ulasan = Ulasan::findOrFail($id);
            $ulasan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus ulasan: ' . $e->getMessage()
            ], 500);
        }
    }
}
