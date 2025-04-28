<?php

namespace App\Http\Controllers\Barberman;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pelangganCount = User::where('role', 'pelanggan')->count();
        $barbermanCount = User::where('role', 'barberman')->count();

        // Get reservations assigned to the logged-in barberman
        $totalReservasi = Reservasi::where('id_barberman', $userId)->count();

        // Get payments for reservations assigned to this barberman (only completed payments)
        $totalPendapatan = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })->where('status', 'completed')->sum('jumlah');

        $pendapatanPerTahun = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })->where('status', 'completed')->whereYear('tanggal_pembayaran', date('Y'))->sum('jumlah');

        $pendapatanPerBulan = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })->where('status', 'completed')->whereMonth('tanggal_pembayaran', date('m'))->sum('jumlah');

        $pendapatanPerHari = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })->where('status', 'completed')->whereDate('tanggal_pembayaran', date('Y-m-d'))->sum('jumlah');

        // Get recent transactions (only completed payments)
        $recentTransactions = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })
            ->where('status', 'completed')
            ->with(['reservasi.user', 'reservasi.layanan'])
            ->orderBy('tanggal_pembayaran', 'desc')
            ->take(5)
            ->get();

        return view('barberman.dashboard.index')
            ->with('pelangganCount', $pelangganCount)
            ->with('barbermanCount', $barbermanCount)
            ->with('totalReservasi', $totalReservasi)
            ->with('totalPendapatan', $totalPendapatan)
            ->with('pendapatanPerTahun', $pendapatanPerTahun)
            ->with('pendapatanPerBulan', $pendapatanPerBulan)
            ->with('pendapatanPerHari', $pendapatanPerHari)
            ->with('recentTransactions', $recentTransactions);
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
                $startDate = $now->copy()->subWeeks(8)->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                $groupByFormat = 'Y-W';
                $labelFormat = 'W';
                $period = CarbonPeriod::create($startDate, '1 week', $endDate);
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

        // Get completed payments data for reservations assigned to this barberman
        $payments = Pembayaran::whereHas('reservasi', function ($query) use ($userId) {
            $query->where('id_barberman', $userId);
        })
            ->where('status', 'completed')  // Only include completed payments
            ->whereBetween('tanggal_pembayaran', [$startDate, $endDate])
            ->with(['reservasi.user', 'reservasi.layanan'])
            ->orderBy('tanggal_pembayaran')
            ->get();

        // Group payments by the selected period
        $groupedPayments = $payments->groupBy(function ($payment) use ($groupByFormat) {
            return Carbon::parse($payment->tanggal_pembayaran)->format($groupByFormat);
        });

        // Prepare chart data
        $chartData = [
            'labels' => [],
            'values' => []
        ];

        // Initialize with all dates in range, with zero values
        foreach ($period as $date) {
            $key = $date->format($groupByFormat);
            $label = $date->format($labelFormat);

            if (!in_array($label, $chartData['labels'])) {
                $chartData['labels'][] = $label;
                $chartData['values'][] = 0;
            }
        }

        // Fill in actual values
        foreach ($groupedPayments as $key => $items) {
            $label = Carbon::createFromFormat($groupByFormat, $key)->format($labelFormat);
            $index = array_search($label, $chartData['labels']);

            if ($index !== false) {
                $chartData['values'][$index] = $items->sum('jumlah');
            }
        }

        // Calculate summary statistics
        $totalRevenue = $payments->sum('jumlah');
        $transactionCount = $payments->count();
        $averageRevenue = $transactionCount > 0 ? $totalRevenue / $transactionCount : 0;

        // Format recent transactions for display
        $recentTransactions = $payments->take(5)->map(function ($payment) {
            return [
                'id' => $payment->id,
                'customer_name' => $payment->reservasi->user->name ?? 'Unknown Customer',
                'service_name' => $payment->reservasi->layanan->nama ?? 'Unknown Service',
                'date' => Carbon::parse($payment->tanggal_pembayaran)->format('d M Y'),
                'amount' => $payment->jumlah
            ];
        });

        return response()->json([
            'summary' => [
                'total' => $totalRevenue,
                'average' => $averageRevenue,
                'count' => $transactionCount
            ],
            'chart' => $chartData,
            'transactions' => $recentTransactions
        ]);
    }
}
