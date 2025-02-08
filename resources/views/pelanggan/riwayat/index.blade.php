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

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Atur Janji Temu Anda dengan Mudah</p>
                        <h1>Riwayat</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="container my-5">
        <!-- Integrated Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Riwayat Reservasi</h3>
                </div>
            </div>
        </div>

        <!-- Responsive Card Layout -->
        <div class="row" id="reservationContainer">

            @if ($RiwayatReservasi->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        Anda belum memiliki riwayat reservasi.
                    </div>
                </div>
            @endif

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
                            <p class="card-text"><strong>Kategori:</strong> {{ $reservasi->kategori_layanan->nama }}
                            </p>
                            <p class="card-text"><strong>Layanan:</strong> {{ $reservasi->layanan->nama }}</p>
                            <p class="card-text"><strong>Barberman:</strong> {{ $reservasi->barberman->name }}</p>
                            <p class="card-text">
                                <strong>Status:</strong>
                                @if ($reservasi->status == 'pending')
                                    <span class="badge badge-warning">Menunggu Pembayaran</span>
                                    <div class="mt-2">
                                        <button class="btn btn-primary btn-sm pay-button"
                                            data-id="{{ $reservasi->id }}">
                                            Bayar Sekarang
                                        </button>
                                        <button class="btn btn-danger btn-sm cancel-button"
                                            data-id="{{ $reservasi->id }}">
                                            Batalkan
                                        </button>
                                    </div>
                                @elseif ($reservasi->status == 'confirmed')
                                    <span class="badge badge-success">Pembayaran Berhasil</span>
                                @elseif ($reservasi->status == 'canceled')
                                    <span class="badge badge-danger">Dibatalkan</span>
                                @elseif ($reservasi->status == 'done')
                                    <span class="badge badge-primary">Selesai</span>
                                @endif
                            </p>
                            @if ($reservasi->pembayaran)
                                <p class="card-text">
                                    <strong>Metode Pembayaran:</strong>
                                    {{ ucfirst($reservasi->pembayaran->metode_pembayaran ?? 'Belum dibayar') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- <!-- Filter Script -->
    <script>
        document.getElementById('searchReservation').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            document.querySelectorAll('.reservation-item').forEach(function(item) {
                item.style.display = item.textContent.toLowerCase().includes(value) ? '' : 'none';
            });
        });
    </script> --}}

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Helper function to get CSRF token
        function getCsrfToken() {
            const token = document.querySelector('meta[name="csrf-token"]');
            return token ? token.content : '';
        }

        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function() {
                const reservasiId = this.dataset.id;
                const csrfToken = getCsrfToken();

                if (!csrfToken) {
                    Swal.fire({
                        title: 'Error',
                        text: 'CSRF token not found. Please refresh the page.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }

                fetch(`/pelanggan/riwayat/pay/${reservasiId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snapToken) {
                            snap.pay(data.snapToken, {
                                onSuccess: function(result) {
                                    Swal.fire({
                                        title: 'Pembayaran Berhasil!',
                                        text: 'Reservasi Anda telah dikonfirmasi. Silakan cek email Anda untuk invoice.',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    }).then(() => {
                                        window.location.href =
                                            `/midtrans/notification?order_id=${result.order_id}&status_code=${result.status_code}&transaction_status=${result.transaction_status}&payment_type=${result.payment_type}`;
                                    });
                                },
                                onPending: function(result) {
                                    Swal.fire({
                                        title: 'Pembayaran Pending',
                                        text: 'Silakan selesaikan pembayaran Anda sesuai instruksi yang diberikan',
                                        icon: 'warning',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    }).then(() => {
                                        window.location.href =
                                            `/midtrans/notification?order_id=${result.order_id}&status_code=${result.status_code}&transaction_status=${result.transaction_status}`;
                                    });
                                },
                                onError: function(result) {
                                    Swal.fire({
                                        title: 'Pembayaran gagal',
                                        text: 'Terjadi kesalahan saat memproses pembayaran',
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.location.href =
                                            `/midtrans/notification?order_id=${result.order_id}&status_code=${result.status_code}&transaction_status=${result.transaction_status}`;
                                    });
                                },
                                onClose: function() {
                                    Swal.fire({
                                        title: 'Pembayaran Tertunda',
                                        text: 'Silahkan kunjungi riwayat reservasi Anda untuk menyelesaikan pembayaran',
                                        icon: 'warning',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });

                                    window.location.reload();
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memproses pembayaran',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    });
            });
        });

        document.querySelectorAll('.cancel-button').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin Ingin Membatalkan Reservasi?',
                    text: 'Reservasi yang dibatalkan tidak dapat dikembalikan',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, batalkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Harap Tunggu',
                            text: 'Sedang membatalakan reservasi...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        const reservasiId = this.dataset.id;
                        const csrfToken = getCsrfToken();

                        if (!csrfToken) {
                            Swal.fire({
                                title: 'Error',
                                text: 'CSRF token not found. Please refresh the page.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return;
                        }

                        fetch(`/pelanggan/riwayat/cancel/${reservasiId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    window.location.reload();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat membatalkan reservasi',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                    }
                });
            });
        });
    </script>
</x-layout>
