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
                            @if ($reservasi->pembayaran)
                                <p class="card-text">
                                    <strong>Metode Pembayaran:</strong>
                                    {{ ucfirst($reservasi->pembayaran->metode_pembayaran ?? 'Belum dibayar') }}
                                </p>
                            @endif
                            <p class="card-text">
                                <strong>Status:</strong>
                                @if ($reservasi->status == 'pending')
                                    <span class="badge badge-warning">Menunggu Pembayaran</span>
                                    <div class="mt-2">
                                        <button class="btn btn-primary btn-sm pay-button"
                                            data-id="{{ $reservasi->id }}">
                                            <i class="fas fa-money-bill-wave"></i> Bayar Sekarang
                                        </button>
                                        <button class="btn btn-danger btn-sm cancel-button"
                                            data-id="{{ $reservasi->id }}">
                                            <i class="fas fa-times"></i> Batalkan
                                        </button>
                                    </div>
                                @elseif ($reservasi->status == 'confirmed')
                                    <span class="badge badge-success">Pembayaran Berhasil</span>
                                    @php
                                        $reservationDate = \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format(
                                            'Y-m-d',
                                        );
                                        $reservationDateTime = \Carbon\Carbon::parse(
                                            $reservationDate . ' ' . $reservasi->jadwal->jam_mulai,
                                        );
                                    @endphp

                                    @if (now()->lt($reservationDateTime->copy()->subHour()))
                                        <div class="mt-2">
                                            @php
                                                // Cari refund record berdasarkan reservation id
                                                $refundRecord = $Refund->firstWhere('reservasi.id', $reservasi->id);
                                            @endphp

                                            @if ($reservasi->pembayaran)
                                                @if ($refundRecord)
                                                    @if ($refundRecord->status == 'pending')
                                                        <span class="badge badge-warning">Permohonan Refund
                                                            Sedang Diproses</span>
                                                    @elseif($refundRecord->status == 'failed')
                                                        <span class="badge badge-danger">Refund Ditolak</span>
                                                    @elseif($refundRecord->status == 'success')
                                                        <div class="d-flex flex-column align-items-start">
                                                            <span class="badge badge-success mb-2">Refund
                                                                Diterima</span>
                                                            @if ($refundRecord->bukti)
                                                                <button
                                                                    class="btn btn-secondary btn-sm view-proof-button"
                                                                    data-bukti-id="{{ $reservasi->id }}">
                                                                    <i class="fas fa-eye"></i> Lihat Bukti
                                                                </button>

                                                                <script>
                                                                    document.querySelector('[data-bukti-id="{{ $reservasi->id }}"]').addEventListener('click', function() {
                                                                        Swal.fire({
                                                                            title: 'Bukti Refund',
                                                                            imageUrl: '{{ asset('uploads/refund/' . $refundRecord->bukti) }}',
                                                                            imageAlt: 'Bukti Refund',
                                                                            showCloseButton: true,
                                                                            showConfirmButton: false,
                                                                        });
                                                                    });
                                                                </script>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-info btn-sm refund-button mr-2"
                                                            data-id="{{ $reservasi->id }}">
                                                            <i class="fas fa-undo-alt"></i> Ajukan Refund
                                                        </button>
                                                        <button class="btn btn-warning btn-sm reschedule-button-custom"
                                                            data-id="{{ $reservasi->id }}"
                                                            data-barberman="{{ $reservasi->barberman->id }}"
                                                            data-tanggal="{{ $reservationDate }}"
                                                            data-jadwal="{{ $reservasi->jadwal->id }}">
                                                            <i class="fas fa-calendar-alt"></i> Reschedule
                                                        </button>

                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                document.querySelectorAll('.reschedule-button-custom').forEach(button => {
                                                                    button.addEventListener('click', function() {
                                                                        const reservasiId = this.dataset.id;
                                                                        const barbermanId = this.dataset.barberman;

                                                                        // Set minimum date to tomorrow
                                                                        const today = new Date();
                                                                        const tomorrow = new Date(today);
                                                                        tomorrow.setDate(tomorrow.getDate() + 1);
                                                                        const minDate = tomorrow.toISOString().split('T')[0];

                                                                        // Initial step - Select date
                                                                        Swal.fire({
                                                                            title: 'Reschedule Reservasi',
                                                                            html: `
                                                                                <form id="rescheduleForm">
                                                                                    <input type="hidden" id="swal_reservasi_id" value="${reservasiId}">
                                                                                    <input type="hidden" id="swal_barberman_id" value="${barbermanId}">
                                                                                    <div class="form-group">
                                                                                        <label for="swal_tanggal" class="text-left d-block mb-2">Pilih Tanggal Baru</label>
                                                                                        <input type="date" class="form-control" id="swal_tanggal" min="${minDate}" required>
                                                                                    </div>
                                                                                </form>
                                                                            `,
                                                                            showCancelButton: true,
                                                                            confirmButtonText: 'Lanjutkan',
                                                                            cancelButtonText: 'Batal',
                                                                            showLoaderOnConfirm: true,
                                                                            preConfirm: () => {
                                                                                const tanggal = document.getElementById('swal_tanggal')
                                                                                    .value;
                                                                                if (!tanggal) {
                                                                                    Swal.showValidationMessage(
                                                                                        'Pilih tanggal terlebih dahulu');
                                                                                    return false;
                                                                                }
                                                                                return tanggal;
                                                                            },
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                const tanggal = result.value;
                                                                                loadTimeSlots(barbermanId, tanggal, reservasiId);
                                                                            }
                                                                        });
                                                                    });
                                                                });

                                                                // Function to load available time slots
                                                                function loadTimeSlots(barbermanId, date, reservasiId) {
                                                                    Swal.fire({
                                                                        title: 'Memuat Jadwal',
                                                                        html: '<i class="fas fa-spinner fa-spin"></i>',
                                                                        showConfirmButton: false,
                                                                        allowOutsideClick: false
                                                                    });

                                                                    fetch(`/get-barberman-schedule/${barbermanId}?tanggal=${date}`)
                                                                        .then(response => response.json())
                                                                        .then(slots => {
                                                                            if (slots.length === 0) {
                                                                                Swal.fire({
                                                                                    icon: 'error',
                                                                                    title: 'Tidak Tersedia',
                                                                                    text: 'Tidak ada jadwal tersedia pada tanggal ini'
                                                                                });
                                                                                return;
                                                                            }

                                                                            let timeSlotHtml = '<div class="form-group">' +
                                                                                '<label class="text-left d-block mb-2">Pilih Waktu Baru</label>' +
                                                                                '<div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">';

                                                                            slots.forEach(slot => {
                                                                                const disabled = !slot.available ? 'disabled' : '';
                                                                                const btnClass = slot.available ? 'btn-outline-primary' :
                                                                                    'btn-danger text-white';
                                                                                // Handle both object formats - either with id/jam_mulai/jam_selesai or with time/available
                                                                                if (slot.jam_mulai && slot.jam_selesai) {
                                                                                    timeSlotHtml += `
                                                                                        <div class="form-check">
                                                                                            <input class="btn-check" type="radio" name="jadwal" 
                                                                                                id="slot_${slot.id}" value="${slot.id}" ${disabled}>
                                                                                            <label class="btn ${btnClass}" for="slot_${slot.id}">
                                                                                                ${slot.jam_mulai} - ${slot.jam_selesai}
                                                                                                ${!slot.available ? ' (Terisi)' : ''}
                                                                                            </label>
                                                                                        </div>
                                                                                    `;
                                                                                } else {
                                                                                    // Handle the new format with just time and available
                                                                                    const slotTime = slot.time;
                                                                                    // Calculate end time (assume 1 hour duration)
                                                                                    const [hours, minutes] = slotTime.split(':');
                                                                                    const endTime =
                                                                                        `${(parseInt(hours) + 1).toString().padStart(2, '0')}:${minutes}`;

                                                                                    timeSlotHtml += `
                                                                                        <div class="form-check">
                                                                                            <input class="btn-check" type="radio" name="jadwal" 
                                                                                                id="slot_${slotTime}" value="${slotTime}" ${disabled}>
                                                                                            <label class="btn ${btnClass}" for="slot_${slotTime}">
                                                                                                ${slotTime} - ${endTime}
                                                                                                ${!slot.available ? ' (Terisi)' : ''}
                                                                                            </label>
                                                                                        </div>
                                                                                    `;
                                                                                }
                                                                            });

                                                                            timeSlotHtml += '</div></div>';

                                                                            Swal.fire({
                                                                                title: 'Pilih Waktu',
                                                                                html: timeSlotHtml,
                                                                                showCancelButton: true,
                                                                                confirmButtonText: 'Konfirmasi Reschedule',
                                                                                cancelButtonText: 'Batal',
                                                                                preConfirm: () => {
                                                                                    const selectedSlot = document.querySelector(
                                                                                        'input[name="jadwal"]:checked');
                                                                                    if (!selectedSlot) {
                                                                                        Swal.showValidationMessage('Pilih waktu terlebih dahulu');
                                                                                        return false;
                                                                                    }
                                                                                    return selectedSlot.value;
                                                                                },
                                                                            }).then((result) => {
                                                                                if (result.isConfirmed) {
                                                                                    submitReschedule(reservasiId, date, result.value);
                                                                                }
                                                                            });
                                                                        })
                                                                        .catch(error => {
                                                                            Swal.fire({
                                                                                icon: 'error',
                                                                                title: 'Error',
                                                                                text: 'Gagal memuat jadwal. Silakan coba lagi.'
                                                                            });
                                                                        });
                                                                }

                                                                // Function to submit reschedule request
                                                                function submitReschedule(reservasiId, tanggal, jadwalId) {
                                                                    Swal.fire({
                                                                        title: 'Harap Tunggu',
                                                                        text: 'Sedang memproses perubahan jadwal...',
                                                                        allowOutsideClick: false,
                                                                        didOpen: () => {
                                                                            Swal.showLoading();
                                                                        }
                                                                    });

                                                                    const formData = new FormData();
                                                                    formData.append('reservasi_id', reservasiId);
                                                                    formData.append('tanggal', tanggal);
                                                                    formData.append('jam_mulai', jadwalId);
                                                                    formData.append('_token', '{{ csrf_token() }}');

                                                                    fetch('{{ route('pelanggan.reschedule') }}', {
                                                                            method: 'POST',
                                                                            body: formData
                                                                        })
                                                                        .then(response => response.json())
                                                                        .then(data => {
                                                                            if (data.status === 'success') {
                                                                                Swal.fire({
                                                                                    icon: 'success',
                                                                                    title: 'Berhasil!',
                                                                                    text: 'Jadwal reservasi berhasil diubah',
                                                                                }).then(() => {
                                                                                    window.location.reload();
                                                                                });
                                                                            } else {
                                                                                Swal.fire({
                                                                                    icon: 'error',
                                                                                    title: 'Gagal!',
                                                                                    text: data.message || 'Terjadi kesalahan saat mengubah jadwal'
                                                                                });
                                                                            }
                                                                        })
                                                                        .catch(error => {
                                                                            Swal.fire({
                                                                                icon: 'error',
                                                                                title: 'Error',
                                                                                text: 'Terjadi kesalahan saat memproses permintaan'
                                                                            });
                                                                        });
                                                                }
                                                            });
                                                        </script>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        <script>
                                            document.querySelector('[data-id="{{ $reservasi->id }}"]').addEventListener('click', function() {
                                                Swal.fire({
                                                    title: 'Ajukan Refund',
                                                    html: `
                                                        <form id="refundForm{{ $reservasi->id }}">
                                                            <div class="form-group">
                                                                <label for="merchant" class="text-left d-block mb-2">Pilih Merchant</label>
                                                                <select class="form-control" id="merchant" name="merchant" required>
                                                                    <option value="">Pilih Merchant</option>
                                                                    <option value="BRI">BANK BRI</option>
                                                                    <option value="BNI">BANK BNI</option>
                                                                    <option value="Dana">Dana</option>
                                                                    <option value="OVO">OVO</option>
                                                                    <option value="GoPay">GoPay</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address_refund" class="text-left d-block mb-2">Nomor Rekening/Nomor Telepon</label>
                                                                <input type="text" class="form-control" id="address_refund" name="address_refund" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address_name" class="text-left d-block mb-2">Nama Pemilik Rekening/Akun</label>
                                                                <input type="text" class="form-control" id="address_name" name="address_name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alasan" class="text-left d-block mb-2">Alasan Refund</label>
                                                                <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                                                            </div>
                                                        </form>
                                                    `,
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Ajukan Refund',
                                                    cancelButtonText: 'Batal',
                                                    preConfirm: () => {
                                                        const alasan = document.getElementById('alasan').value;
                                                        if (!alasan) {
                                                            Swal.showValidationMessage('Alasan refund harus diisi');
                                                            return false;
                                                        }
                                                        return alasan;
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        const formData = new FormData();
                                                        formData.append('id_reservasi', '{{ $reservasi->id }}');
                                                        formData.append('id_pembayaran',
                                                            '{{ $reservasi->pembayaran ? $reservasi->pembayaran->id : '' }}');
                                                        formData.append('alasan', result.value);
                                                        formData.append('merchant', document.getElementById('merchant').value);
                                                        console.log(document.getElementById('merchant').value);
                                                        formData.append('address_refund', document.getElementById('address_refund').value);
                                                        formData.append('address_name', document.getElementById('address_name').value);

                                                        formData.append('_token', '{{ csrf_token() }}');
                                                        Swal.fire({
                                                            title: 'Harap Tunggu',
                                                            text: 'Sedang mengajukan refund...',
                                                            allowOutsideClick: false,
                                                            didOpen: () => {
                                                                Swal.showLoading();
                                                            }
                                                        });

                                                        fetch('{{ route('pelanggan.refund', $reservasi->id) }}', {
                                                                method: 'POST',
                                                                body: formData
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                if (data.status === 'success') {
                                                                    Swal.fire('Berhasil!', 'Pengajuan refund telah dikirim', 'success')
                                                                        .then(() => {
                                                                            window.location.reload();
                                                                        });
                                                                } else {
                                                                    Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                                                                }
                                                            });
                                                    }
                                                });
                                            });
                                        </script>
                                    @endif
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
