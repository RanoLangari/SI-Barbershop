<?php

namespace App\Http\Controllers\Barberman;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get data for online reservations
        $reservasi = Reservasi::with(['user', 'layanan', 'barberman'])
            ->where('id_barberman', auth()->id()) // Changed from barberman_id to id_barberman
            ->get();

        // Get data for offline orders
        $orders = Order::with(['layanan', 'barberman'])
            ->where('id_barberman', auth()->id()) // Changed from barberman_id to id_barberman
            ->get();

        // Format offline orders to match the structure expected in the view
        $formattedOrders = $orders->map(function ($order) {
            $order->is_offline = true;
            return $order;
        });

        // Count values
        $totalReservasi = $reservasi->count();
        $totalOrder = $orders->count();
        $totalTransaksi = $totalReservasi + $totalOrder;

        // Count unique customers from both online and offline transactions
        $onlinePelangganIds = $reservasi->pluck('user_id')->filter()->unique();
        $onlinePelangganCount = $onlinePelangganIds->count();
        
        // For offline, use nama_pemesan if available, otherwise use a placeholder
        $offlinePelangganNames = $orders->pluck('nama_pemesan')->filter()->unique();
        $offlinePelangganCount = $offlinePelangganNames->count();
        
        // Total unique customers (this is an approximate count as names might not be unique)
        $pelangganCount = $onlinePelangganCount + $offlinePelangganCount;
        
        // Count barbermen (adjust as needed for your application)
        $barbermanCount = \App\Models\User::where('role', 'barberman')->count();

        // Calculate total revenue
        $pendapatanReservasi = $reservasi->sum(function ($item) {
            return $item->layanan->harga ?? 0;
        });

        $pendapatanOrder = $orders->sum(function ($item) {
            return $item->layanan->harga ?? 0;
        });

        $totalPendapatan = $pendapatanReservasi + $pendapatanOrder;

        // Combine recent transactions
        $allTransactions = $reservasi->concat($formattedOrders)->sortByDesc(function ($item) {
            return $item->is_offline ?? false ? $item->tanggal : $item->tanggal_reservasi;
        });

        $recentTransactions = $allTransactions->take(10); // Get the 10 most recent transactions

        return view('barberman.dashboard.index', compact(
            'totalReservasi',
            'totalOrder',
            'totalTransaksi',
            'pelangganCount',
            'barbermanCount',
            'totalPendapatan',
            'recentTransactions'
        ));
    }

    public function getRevenueData(Request $request)
    {
        $userId = Auth::id();
        $filterType = $request->input('filter', 'daily');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Set up date ranges based on filter type
        $now = Carbon::now();

        switch ($filterType) {
            case 'daily':
                $startDate = $now->copy()->subDays(7)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $groupByFormat = 'Y-m-d';
                $labelFormat = 'd M';
                $period = CarbonPeriod::create($startDate, '1 day', $endDate);
                break;
            case 'weekly':
                // Fix for weekly view - use ISO-8601 week numbering system
                $startDate = $now->copy()->subWeeks(8)->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                $groupByFormat = 'o-W'; // ISO-8601 year and week number
                $labelFormat = '\WW'; // Week number format (W1, W2, etc.)
                
                // Create weekly periods manually for better control
                $period = collect();
                $currentDate = $startDate->copy();
                while ($currentDate <= $endDate) {
                    $period->add($currentDate->copy());
                    $currentDate->addWeek();
                }
                break;
            case 'monthly':
                $startDate = $now->copy()->subMonths(12)->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                $groupByFormat = 'Y-m';
                $labelFormat = 'M Y';
                $period = CarbonPeriod::create($startDate, '1 month', $endDate);
                break;
            case 'yearly':
                $startDate = $now->copy()->subYears(5)->startOfYear();
                $endDate = $now->copy()->endOfYear();
                $groupByFormat = 'Y';
                $labelFormat = 'Y';
                $period = CarbonPeriod::create($startDate, '1 year', $endDate);
                break;
            case 'custom':
                $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
                $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

                // Determine appropriate grouping based on date range
                $diffInDays = $startDate->diffInDays($endDate);

                if ($diffInDays <= 31) {
                    $groupByFormat = 'Y-m-d';
                    $labelFormat = 'd M';
                    $period = CarbonPeriod::create($startDate, '1 day', $endDate);
                } elseif ($diffInDays <= 120) {
                    $groupByFormat = 'Y-W';
                    $labelFormat = 'W';
                    $period = CarbonPeriod::create($startDate, '1 week', $endDate);
                } elseif ($diffInDays <= 730) {
                    $groupByFormat = 'Y-m';
                    $labelFormat = 'M Y';
                    $period = CarbonPeriod::create($startDate, '1 month', $endDate);
                } else {
                    $groupByFormat = 'Y';
                    $labelFormat = 'Y';
                    $period = CarbonPeriod::create($startDate, '1 year', $endDate);
                }
                break;
        }

        // ONLINE TRANSACTIONS - Get completed payments data
        $onlinePayments = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })
            ->where('status', 'completed')  // Only include completed payments
            ->whereBetween('tanggal_pembayaran', [$startDate, $endDate])
            ->with(['reservasi.user', 'reservasi.layanan'])
            ->orderBy('tanggal_pembayaran')
            ->get();

        // OFFLINE TRANSACTIONS - Get orders within the date range
        $offlineOrders = Order::where('id_barberman', $userId)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with(['layanan', 'barberman'])
            ->get();

        // Group online payments by the selected period
        $groupedOnlinePayments = $onlinePayments->groupBy(function ($payment) use ($groupByFormat, $filterType) {
            $date = Carbon::parse($payment->tanggal_pembayaran);
            return $date->format($groupByFormat);
        });

        // Group offline orders by the selected period
        $groupedOfflineOrders = $offlineOrders->groupBy(function ($order) use ($groupByFormat, $filterType) {
            $date = Carbon::parse($order->tanggal);
            return $date->format($groupByFormat);
        });

        // Prepare chart data
        $chartData = [
            'labels' => [],
            'onlineValues' => [],
            'offlineValues' => [],
            'totalValues' => []
        ];

        // Initialize with all dates in range, with zero values
        if ($filterType === 'weekly') {
            // Special handling for weekly view
            foreach ($period as $date) {
                $key = $date->format($groupByFormat);
                $label = 'Week ' . $date->format('W');
                
                if (!in_array($label, $chartData['labels'])) {
                    $chartData['labels'][] = $label;
                    $chartData['onlineValues'][] = 0;
                    $chartData['offlineValues'][] = 0;
                    $chartData['totalValues'][] = 0;
                }
            }
        } else {
            // Regular handling for other time periods
            foreach ($period as $date) {
                $key = $date->format($groupByFormat);
                $label = $date->format($labelFormat);

                if (!in_array($label, $chartData['labels'])) {
                    $chartData['labels'][] = $label;
                    $chartData['onlineValues'][] = 0;
                    $chartData['offlineValues'][] = 0;
                    $chartData['totalValues'][] = 0;
                }
            }
        }

        // Fill in actual values for online transactions
        foreach ($groupedOnlinePayments as $key => $items) {
            $index = null;
            
            if ($filterType === 'weekly') {
                // For weekly view, extract week number
                $dateParts = explode('-', $key);
                if (count($dateParts) === 2) {
                    $weekNum = 'Week ' . $dateParts[1];
                    $index = array_search($weekNum, $chartData['labels']);
                }
            } else {
                // For other views, use standard formatting
                $date = Carbon::createFromFormat($groupByFormat, $key);
                $label = $date->format($labelFormat);
                $index = array_search($label, $chartData['labels']);
            }

            if ($index !== false && $index !== null) {
                $chartData['onlineValues'][$index] = $items->sum('jumlah');
                $chartData['totalValues'][$index] += $items->sum('jumlah');
            }
        }

        // Fill in actual values for offline transactions
        foreach ($groupedOfflineOrders as $key => $items) {
            $index = null;
            
            if ($filterType === 'weekly') {
                // For weekly view, extract week number
                $dateParts = explode('-', $key);
                if (count($dateParts) === 2) {
                    $weekNum = 'Week ' . $dateParts[1];
                    $index = array_search($weekNum, $chartData['labels']);
                }
            } else {
                // For other views, use standard formatting
                $date = Carbon::createFromFormat($groupByFormat, $key);
                $label = $date->format($labelFormat);
                $index = array_search($label, $chartData['labels']);
            }

            if ($index !== false && $index !== null) {
                $amount = $items->sum(function($item) {
                    return $item->layanan->harga ?? 0;
                });
                $chartData['offlineValues'][$index] = $amount;
                $chartData['totalValues'][$index] += $amount;
            }
        }

        // Calculate summary statistics
        $totalOnlineRevenue = $onlinePayments->sum('jumlah');
        $totalOfflineRevenue = $offlineOrders->sum(function($item) {
            return $item->layanan->harga ?? 0;
        });
        $totalRevenue = $totalOnlineRevenue + $totalOfflineRevenue;
        
        $onlineTransactionCount = $onlinePayments->count();
        $offlineTransactionCount = $offlineOrders->count();
        $transactionCount = $onlineTransactionCount + $offlineTransactionCount;
        
        $averageRevenue = $transactionCount > 0 ? $totalRevenue / $transactionCount : 0;

        // Combine online and offline transactions for recent transactions display
        $allTransactions = collect();
        
        // Format online transactions
        foreach ($onlinePayments->take(5) as $payment) {
            $allTransactions->push([
                'id' => $payment->id,
                'type' => 'online',
                'customer_name' => $payment->reservasi->user->name ?? 'Unknown Customer',
                'service_name' => $payment->reservasi->layanan->nama ?? 'Unknown Service',
                'date' => Carbon::parse($payment->tanggal_pembayaran)->format('d M Y'),
                'amount' => $payment->jumlah
            ]);
        }
        
        // Format offline transactions
        foreach ($offlineOrders->take(5) as $order) {
            $allTransactions->push([
                'id' => $order->id,
                'type' => 'offline',
                'customer_name' => $order->nama_pemesan ?? 'Walk-in Customer',
                'service_name' => $order->layanan->nama ?? 'Unknown Service',
                'date' => Carbon::parse($order->tanggal)->format('d M Y'),
                'amount' => $order->layanan->harga ?? 0
            ]);
        }
        
        // Sort by date (newest first) and take only 5
        $recentTransactions = $allTransactions->sortByDesc('date')->take(5)->values()->all();

        return response()->json([
            'summary' => [
                'total' => $totalRevenue,
                'online' => $totalOnlineRevenue,
                'offline' => $totalOfflineRevenue,
                'average' => $averageRevenue,
                'count' => $transactionCount,
                'onlineCount' => $onlineTransactionCount,
                'offlineCount' => $offlineTransactionCount
            ],
            'chart' => $chartData,
            'transactions' => $recentTransactions
        ]);
    }
}
