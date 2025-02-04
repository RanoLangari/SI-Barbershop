<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice Pembayaran</title>
    <!-- Import Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
</head>

<body style="font-family: 'Roboto', sans-serif; background: #f3f7fb; color: #444; line-height: 1.6; padding: 30px;">
    <div
        style="max-width:850px; margin:30px auto; background:#ffffff; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.1); overflow:hidden;">
        <!-- Header -->
        <div
            style="background: linear-gradient(135deg, #4a90e2, #357ab8); color: #fff; padding: 25px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom:4px solid rgba(0,0,0,0.1);">
            <div>
                <h1 style="font-size:2rem; letter-spacing:1px; margin:0;">
                    Zeroseven<span style="color:#f5a623;">Barbershop</span>
                </h1>
                <p style="margin-top:5px; font-size:1rem; opacity:0.9;">Invoice Pembayaran</p>
            </div>
        </div>

        <!-- Content -->
        <div style="padding:30px;">
            <!-- Customer dan Transaksi -->
            <div style="display:flex; justify-content:space-between; flex-wrap:wrap; margin-bottom:25px; gap:20px;">
                <div
                    style="flex: 1 1 45%; background:#fafafa; padding:15px 20px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <h2
                        style="margin-bottom:15px; font-size:1.3rem; color:#333; border-left:4px solid #4a90e2; padding-left:10px;">
                        Detail Pelanggan</h2>
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">Nama:</strong>
                        {{ $reservasi->user->name }}</p>
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">Email:</strong>
                        {{ $reservasi->user->email }}</p>
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">Telepon:</strong>
                        {{ $reservasi->user->no_telepon }}</p>
                </div>
                <div
                    style="flex: 1 1 45%; background:#fafafa; padding:15px 20px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <h2
                        style="margin-bottom:15px; font-size:1.3rem; color:#333; border-left:4px solid #4a90e2; padding-left:10px;">
                        Detail Transaksi</h2>
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">No. Invoice:</strong>
                        {{ $reservasi->pembayaran->transaksi_id }}</p>
                    <p style="margin-bottom:8px; font-size:0.95rem;">
                        <strong style="color:#555;">Tanggal:</strong>
                        {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }}
                    </p>
                    <p style="margin-bottom:8px; font-size:0.95rem;">
                        <strong style="color:#555;">Status:</strong>
                        <span
                            style="display:inline-block; padding:4px 10px; background:#27ae60; color:#fff; border-radius:20px; font-size:0.9rem; text-transform:capitalize;">
                            {{ ucfirst($reservasi->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Detail Layanan -->
            <div style="margin-bottom:25px;">
                <h2
                    style="margin-bottom:15px; font-size:1.3rem; color:#333; border-left:4px solid #4a90e2; padding-left:10px;">
                    Detail Layanan</h2>
                <div
                    style="background:#fff; padding:20px; border-radius:10px; border:1px solid #e0e0e0; box-shadow:0 2px 8px rgba(0,0,0,0.03); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">Kategori:</strong>
                        {{ $reservasi->kategori_layanan->nama }}</p>
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">Layanan:</strong>
                        {{ $reservasi->layanan->nama }}</p>
                    <p style="margin-bottom:8px; font-size:0.95rem;"><strong style="color:#555;">Barberman:</strong>
                        {{ $reservasi->barberman->name }}</p>
                    <p style="margin-bottom:8px; font-size:0.95rem;">
                        <strong style="color:#555;">Tanggal Reservasi:</strong>
                        {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }} -
                        {{ $reservasi->jadwal->jam_mulai }}
                    </p>
                </div>
            </div>

            <!-- Detail Pembayaran -->
            <div style="margin-bottom:25px;">
                <h2
                    style="margin-bottom:15px; font-size:1.3rem; color:#333; border-left:4px solid #4a90e2; padding-left:10px;">
                    Detail Pembayaran</h2>
                <div
                    style="background:#fff; padding:20px; border-radius:10px; border:1px solid #e0e0e0; box-shadow:0 2px 8px rgba(0,0,0,0.03); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <table style="width:100%; border-collapse:collapse; margin-top:15px;">
                        <thead>
                            <tr>
                                <th
                                    style="padding:12px 15px; text-align:left; background:#f0f8ff; border-bottom:2px solid #c8d6e5; font-weight:500; color:#333;">
                                    Metode Pembayaran</th>
                                <th
                                    style="padding:12px 15px; text-align:left; background:#f0f8ff; border-bottom:2px solid #c8d6e5; font-weight:500; color:#333;">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid #e6e6e6;">
                                <td style="padding:12px 15px; font-size:0.95rem;">
                                    {{ ucwords($reservasi->pembayaran->metode_pembayaran) }}</td>
                                <td style="padding:12px 15px; font-size:0.95rem;">Rp
                                    {{ number_format($reservasi->layanan->harga, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total -->
            <div style="display:flex; justify-content:flex-end; margin-top:30px; padding:0 20px;">
                <div
                    style="width:280px; background:linear-gradient(135deg, #fff, #f9f9f9); padding:15px 20px; border-radius:8px; border:1px solid #e0e0e0; box-shadow:0 3px 10px rgba(0,0,0,0.05);">
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span style="font-weight:500; color:#555; font-size:1rem;">Total:</span>
                        <span style="font-weight:700; color:#e67e22; font-size:1rem;">Rp
                            {{ number_format($reservasi->layanan->harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div
            style="background:#f0f8ff; text-align:center; padding:20px; border-top:2px solid #c8d6e5; font-size:0.9rem; color:#666;">
            <p style="margin:5px 0;">Terima kasih telah menggunakan layanan Zeroseven Barbershop</p>
            <p style="margin:5px 0;"> &copy; 2021 Zeroseven Barbershop. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
