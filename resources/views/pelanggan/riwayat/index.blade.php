<x-layout>
    <style>
        .reservation-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .reservation-card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
        }

        .fade-in {
            animation: fadeInAnimation 0.5s ease-in;
        }

        @keyframes fadeInAnimation {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <div class="container my-5">
        <!-- Integrated Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <input type="text" id="searchReservation" class="form-control" placeholder="Cari reservasi...">
            </div>
        </div>

        <!-- Responsive Card Layout -->
        <div class="row" id="reservationContainer">
            @foreach ($RiwayatReservasi as $reservasi)
                <div class="col-md-4 mb-4 reservation-item fade-in">
                    <div class="card reservation-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar-alt fa-lg text-primary mr-2"></i>
                                <h5 class="card-title mb-0">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }} -
                                    {{ $reservasi->jadwal->jam_mulai }}
                                </h5>
                            </div>
                            <p class="card-text"><strong>Kategori:</strong> {{ $reservasi->kategori_layanan->nama }}</p>
                            <p class="card-text"><strong>Layanan:</strong> {{ $reservasi->layanan->nama }}</p>
                            <p class="card-text"><strong>Barberman:</strong> {{ $reservasi->barberman->name }}</p>
                            <p class="card-text">
                                <strong>Status:</strong>
                                @if ($reservasi->status == 'pending')
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                @elseif ($reservasi->status == 'confirmed')
                                    <span class="badge badge-success">Dikonfirmasi</span>
                                @elseif ($reservasi->status == 'canceled')
                                    <span class="badge badge-danger">Dibatalkan</span>
                                @elseif ($reservasi->status == 'done')
                                    <span class="badge badge-primary">Selesai</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Filter Script -->
    <script>
        document.getElementById('searchReservation').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            document.querySelectorAll('.reservation-item').forEach(function(item) {
                item.style.display = item.textContent.toLowerCase().includes(value) ? '' : 'none';
            });
        });
    </script>
</x-layout>
