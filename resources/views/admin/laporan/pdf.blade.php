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
            /* Add this line */
        }

        th,
        td {
            padding: 5px;
            /* Adjust padding */
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
    </style>
</head>

<body>
    <header>
        <h1>ZeroSeven Barbershop</h1>
        <p>Jl. Oekam,Kupang,NTT</p>
        <p>Email:zerosevenbarbershop@gmail.com | Tel: (021) 12345678</p>
        <p> Tanggal: {{ $minDate }} - {{ $maxDate }}</p> <!-- Modify this line -->
    </header>

    <h2>Laporan Keuangan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th> <!-- Add this line -->
                <th>Nama</th>
                <th>Kategori Layanan</th>
                <th>Layanan</th>
                <th>Barberman</th>
                <th>Jadwal</th>
                <th>Harga</th>
                <th>Tanggal Reservasi</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservasi as $index => $item)
                <!-- Modify this line -->
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Add this line -->
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->kategori_layanan->nama }}</td>
                    <td>{{ $item->layanan->nama }}</td>
                    <td>{{ $item->barberman->name }}</td>
                    <td>{{ $item->jadwal->tanggal }} {{ $item->jadwal->jam_mulai }} - {{ $item->jadwal->jam_selesai }}
                    </td>
                    <td>{{ $item->layanan->harga }}</td>
                    <td>{{ $item->tanggal_reservasi }}</td>
                    <td>{{ $item->pembayaran->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <p>Page <span class="pageNumber"></span></p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var pageNumber = 1;
            document.querySelector('.pageNumber').textContent = pageNumber;
        });
    </script>
</body>

</html>
