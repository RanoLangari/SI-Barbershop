<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        /* Add your PDF styles here */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
            font-size: 10px;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #ddd;
            overflow: hidden;
        }

        th {
            background-color: #0D1B2A;
            color: white;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        .badge {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 3px;
            color: white;
            font-weight: bold;
        }

        .badge-blue {
            background-color: #3490dc;
        }

        .badge-orange {
            background-color: #f6993f;
        }

        .date-range {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>ZeroSeven Barbershop</h1>
        <p>Jl. Oekam, Kupang, NTT</p>
        <p>Email: zerosevenbarbershop@gmail.com | Tel: (021) 12345678</p>
        <div class="date-range">
            @if ($minDate && $maxDate)
                Periode: {{ date('d-m-Y', strtotime($minDate)) }} - {{ date('d-m-Y', strtotime($maxDate)) }}
            @else
                Periode: Semua Transaksi
            @endif
        </div>
    </header>

    <h2>Laporan Keuangan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Kategori Layanan</th>
                <th>Layanan</th>
                <th>Barberman</th>
                <th>Tanggal</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPendapatan = 0; @endphp
            @foreach ($allTransactions as $index => $item)
                @php $totalPendapatan += $item->layanan->harga; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ isset($item->is_offline) ? $item->nama_pemesan : $item->user->name }}</td>
                    <td>
                        @if (isset($item->is_offline))
                            <span class="badge badge-orange">Offline</span>
                        @else
                            <span class="badge badge-blue">Online</span>
                        @endif
                    </td>
                    <td>{{ $item->kategori->nama }}</td>
                    <td>{{ $item->layanan->nama }}</td>
                    <td>{{ $item->barberman->name }}</td>
                    <td>{{ isset($item->is_offline) ? date('d-m-Y', strtotime($item->tanggal)) : date('d-m-Y', strtotime($item->tanggal_reservasi)) }}
                    </td>
                    <td>{{ 'Rp ' . number_format($item->layanan->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="text-align: right;"><strong>Total Pendapatan:</strong></td>
                <td>{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <p>Total Transaksi: {{ $allTransactions->count() }}</p>
        <p>Total Transaksi Online:
            {{ $allTransactions->filter(function ($item) {return !isset($item->is_offline);})->count() }}</p>
        <p>Total Transaksi Offline:
            {{ $allTransactions->filter(function ($item) {return isset($item->is_offline);})->count() }}</p>
    </div>

    <footer>
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </footer>
</body>

</html>
