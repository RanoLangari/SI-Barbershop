<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF; // Make sure to install the barryvdh/laravel-dompdf package

class LaporanController extends Controller
{ 
    public function index(Request $request)
    {
        // Query for online reservations
        $queryReservasi = Reservasi::with('kategori', 'layanan', 'barberman', 'user', 'jadwal', 'pembayaran')
            ->orderBy('tanggal_reservasi', 'desc');

        // Query for offline orders
        $queryOrder = Order::with(['kategori', 'layanan', 'barberman', 'user'])
            ->orderBy('tanggal', 'desc');

        $minDate = $request->minDate;
        $maxDate = $request->maxDate;

        if ($request->has('minDate') && $request->has('maxDate')) {
            // Apply date filter to online reservations
            $queryReservasi->whereBetween('tanggal_reservasi', [$minDate, $maxDate]);
            
            // Apply date filter to offline orders
            $queryOrder->whereBetween('tanggal', [$minDate, $maxDate]);
        }

        $reservasi = $queryReservasi->get();
        $orders = $queryOrder->get();

        // Format offline orders to match the structure expected in the view
        $formattedOrders = $orders->map(function ($order) {
            $order->tanggal_reservasi = $order->tanggal;
            $order->is_offline = true;
            return $order;
        });

        // Merge both collections
        $mergedTransactions = $reservasi->concat($formattedOrders)->sortByDesc(function ($item) {
            return $item->is_offline ?? false ? $item->tanggal : $item->tanggal_reservasi;
        });

        // Paginate the merged collection manually
        $page = $request->input('page', 1);
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        
        $allTransactions = new \Illuminate\Pagination\LengthAwarePaginator(
            $mergedTransactions->slice($offset, $perPage),
            $mergedTransactions->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.laporan.index', compact('allTransactions', 'minDate', 'maxDate'));
    }

    public function generatePdf(Request $request)
    {
        // Query for online reservations
        $queryReservasi = Reservasi::with('kategori', 'layanan', 'barberman', 'user', 'jadwal', 'pembayaran')
            ->orderBy('tanggal_reservasi', 'desc');

        // Query for offline orders
        $queryOrder = Order::with(['kategori', 'layanan', 'barberman', 'user'])
            ->orderBy('tanggal', 'desc');

        $minDate = $request->query('minDate');
        $maxDate = $request->query('maxDate');

        if (!empty($minDate) && !empty($maxDate)) {
            // Apply date filter to online reservations
            $queryReservasi->whereBetween('tanggal_reservasi', [$minDate, $maxDate]);
            
            // Apply date filter to offline orders
            $queryOrder->whereBetween('tanggal', [$minDate, $maxDate]);
        }

        $reservasi = $queryReservasi->get();
        $orders = $queryOrder->get();
        
        // Format offline orders to match the structure expected in the view
        $formattedOrders = $orders->map(function ($order) {
            $order->tanggal_reservasi = $order->tanggal;
            $order->is_offline = true;
            return $order;
        });

        // Merge both collections
        $allTransactions = $reservasi->concat($formattedOrders)->sortByDesc(function ($item) {
            return $item->is_offline ?? false ? $item->tanggal : $item->tanggal_reservasi;
        });

        // Calculate total revenue
        $totalRevenue = $allTransactions->sum(function ($item) {
            return $item->layanan->harga;
        });

        $pdf = PDF::loadView('admin.laporan.pdf', compact('allTransactions', 'minDate', 'maxDate', 'totalRevenue'));
        
        // Set PDF orientation to landscape for better readability of the table
        $pdf->setPaper('a4', 'landscape');
        
        // Generate a meaningful filename with the date range if provided
        $filename = 'laporan_keuangan';
        if (!empty($minDate) && !empty($maxDate)) {
            $filename .= '_' . $minDate . '_hingga_' . $maxDate;
        }
        $filename .= '.pdf';
        
        return $pdf->download($filename);
    }

    public function getTransactionDetail($id, Request $request)
    {
        $isOffline = $request->query('is_offline', 0);
        
        try {
            if ($isOffline == 1) {
                // Using Order model for offline transactions, not TransaksiOffline
                $transaction = Order::with(['kategori', 'layanan', 'barberman', 'user'])
                    ->findOrFail($id);
                
                // Add the is_offline flag to make frontend handling consistent
                $transaction->is_offline = true;
            } else {
                // Online transaction
                $transaction = Reservasi::with(['kategori', 'layanan', 'barberman', 'user', 'jadwal', 'pembayaran'])
                    ->findOrFail($id);
            }
            
            return response()->json([
                'success' => true,
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
