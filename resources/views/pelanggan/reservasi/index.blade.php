<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .category-card:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }

        .form-check-input:checked+label .category-card {
            border-color: #0d6efd !important;
            background-color: #e7f1ff;
        }

        .service-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .service-card.selected {
            border-color: #0d6efd !important;
            background-color: #e7f1ff;
        }

        #layananSection {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modal loading spinner styles */
        .modal-loader {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .detail-btn {
            background-color: #5c636a;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            margin-left: 0.5rem;
            transition: all 0.2s;
        }

        .detail-btn:hover {
            background-color: #444b52;
            transform: translateY(-1px);
        }
    </style>

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Atur Janji Temu Anda dengan Mudah</p>
                        <h1>Reservasi</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- Service Detail Modal -->
    <div class="modal fade" id="layananDetailModal" tabindex="-1" aria-labelledby="layananDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="layananDetailModalLabel">Detail Layanan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="layananDetailLoading" class="modal-loader">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
                    <div id="layananDetailContent" style="display: none;">
                        <div class="row">
                            <div class="col-md-5">
                                <img id="layananDetailImage" src="" alt="Gambar Layanan"
                                    class="img-fluid rounded mb-3">
                            </div>
                            <div class="col-md-7">
                                <h4 id="layananDetailNama" class="mb-3"></h4>
                                <p><strong>Kategori:</strong> <span id="layananDetailKategori"></span></p>
                                <p><strong>Harga:</strong> <span id="layananDetailHarga"></span></p>
                                <div class="mb-3">
                                    <strong>Deskripsi:</strong>
                                    <p id="layananDetailDeskripsi" class="mt-2"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="layananDetailError" class="alert alert-danger" style="display: none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- reservation form -->
    <div class="reservation-form-section mt-150 mb-150">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title text-center">
                        <h2>Reservasi di Barbershop ZeroSeven</h2>
                        <p>Atur janji temu Anda dengan mudah di Barbershop ZeroSeven. Kami siap memberikan
                            pelayanan terbaik untuk Anda!</p>
                    </div>
                    <div id="form_status"></div>
                    <div class="card shadow-lg p-4">
                        <h4 class="mb-4">Data Pemesan</h4>
                        <form method="POST" id="barbershop-reservation">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label">No. Telepon</label>
                                    <input type="tel" class="form-control" name="phone"
                                        value="{{ Auth::user()->no_telepon }}" required>
                                </div>
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="id_pembayaran" value="1">
                            </div>
                        </form>
                    </div>

                    <div class="card shadow-lg p-4 mt-4">
                        <h4 class="mb-4">Pilih Kategori Layanan</h4>
                        <div class="row">
                            @foreach ($Kategori as $kategori)
                                <div class="col-md-6 mb-3">
                                    <input class="form-check-input" type="radio" name="kategori_id"
                                        id="kategori{{ $kategori->id }}" value="{{ $kategori->id }}"
                                        style="position: absolute; opacity: 0;" required>
                                    <label class="w-100" for="kategori{{ $kategori->id }}">
                                        <div class="category-card p-3 rounded-3 border shadow-sm mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                @if ($kategori->gambar)
                                                    <div class="category-image rounded-circle overflow-hidden"
                                                        style="width: 60px; height: 60px; margin-right: 10px;">
                                                        <img src="{{ asset('storage/' . $kategori->gambar) }}"
                                                            alt="{{ $kategori->nama }}" class="w-100 h-100"
                                                            style="object-fit: cover;">
                                                    </div>
                                                @endif
                                                <div class="category-info flex-grow-1">
                                                    <h5 class="mb-1 fw-bold">{{ $kategori->nama }}</h5>
                                                    <p class="text-muted mb-0 small">{{ $kategori->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card shadow-lg p-4 mt-4" id="layananSection">
                        <h4 class="mb-4">Pilih Layanan</h4>
                        <div class="row" id="layananContainer"></div>
                    </div>

                    <div class="card shadow-lg p-4 mt-4" id="barbermanSection" style="display: none;">
                        <h4 class="mb-4">Pilih Barberman</h4>
                        <div class="row" id="barbermanContainer"></div>
                    </div>

                    <div class="card shadow-lg p-4 mt-4" id="scheduleSection" style="display: none;">
                        <h4 class="mb-4">Pilih Jadwal Reservasi</h4>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tanggal" class="form-label">Tanggal Reservasi</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="jam" class="form-label">Jam Reservasi</label>
                                <div id="timeSlots" class="d-flex flex-wrap gap-2">
                                    <p class="text-muted">Pilih tanggal terlebih dahulu</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" id="pay-button" class="btn btn-primary btn-lg"
                                style="display: none;">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- load ajax, jquery, sweetalert2 and snap.js --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Load Midtrans Snap.js if checkout is triggered -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category selection
            document.querySelectorAll('input[name="kategori_id"]').forEach(input => {
                input.addEventListener('change', function() {
                    const kategoriId = this.value;
                    // Insert or update hidden input for kategori_id in the reservation form
                    let hiddenKategori = document.querySelector('input[name="kategori_id"]');
                    if (!hiddenKategori) {
                        hiddenKategori = document.createElement('input');
                        hiddenKategori.type = 'hidden';
                        hiddenKategori.name = 'kategori_id';
                        document.getElementById('barbershop-reservation').appendChild(
                            hiddenKategori);
                    }
                    hiddenKategori.value = kategoriId;

                    const layananSection = document.getElementById('layananSection');
                    const layananContainer = document.getElementById('layananContainer');
                    layananSection.style.display = 'block';
                    layananContainer.innerHTML = `
                        <div class="col-12 text-center">
                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                            <p class="mt-2">Memuat Layanan...</p>
                        </div>`;

                    fetch(`/get-layanan-by-kategori/${kategoriId}`)
                        .then(response => response.json())
                        .then(data => {
                            layananContainer.innerHTML = data.map(layanan => `
                                <div class="col-md-6 mb-3">
                                    <div class="service-card p-3 rounded-3 border"
                                         onclick="selectService(this, ${layanan.id})">
                                        <div class="d-flex align-items-center gap-3">
                                            ${layanan.gambar ? `
                                                                                            <div class="service-image rounded overflow-hidden" 
                                                                                                style="width: 80px; height: 80px; margin-right: 10px;">
                                                                                                <img src="/storage/${layanan.gambar}" alt="${layanan.nama}" 
                                                                                                    class="w-100 h-100" style="object-fit: cover;">
                                                                                            </div>
                                                                                        ` : ''}
                                            <div class="service-info flex-grow-1">
                                                <h5 class="mb-1">${layanan.nama}</h5>
                                                <p class="text-muted mb-2" style="font-size: 1rem;">${layanan.detail}</p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-primary p-2" style="font-size: 1.1rem;">
                                                        Rp ${new Intl.NumberFormat('id-ID').format(layanan.harga)}
                                                    </span>
                                                    <button type="button" class="detail-btn" 
                                                        onclick="event.stopPropagation(); showLayananDetail(${layanan.id})">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('');
                        })
                        .catch(error => {
                            console.error(error);
                            layananContainer.innerHTML = `
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        Gagal memuat layanan. Silakan coba lagi.
                                    </div>
                                </div>`;
                        });
                });
            });
        });

        // Function to show layanan detail modal
        function showLayananDetail(layananId) {
            // Reset modal content
            document.getElementById('layananDetailContent').style.display = 'none';
            document.getElementById('layananDetailError').style.display = 'none';
            document.getElementById('layananDetailLoading').style.display = 'flex';

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('layananDetailModal'));
            modal.show();

            // Fetch layanan details
            fetch(`/get-layanan-detail/${layananId}`)
                .then(response => response.json())
                .then(result => {
                    document.getElementById('layananDetailLoading').style.display = 'none';

                    if (result.success) {
                        const layanan = result.data;
                        // Update modal content
                        document.getElementById('layananDetailNama').textContent = layanan.nama;
                        document.getElementById('layananDetailKategori').textContent = layanan.kategori ? layanan
                            .kategori.nama : '-';
                        document.getElementById('layananDetailHarga').textContent =
                            `Rp ${new Intl.NumberFormat('id-ID').format(layanan.harga)}`;
                        document.getElementById('layananDetailDeskripsi').textContent = layanan.detail;

                        const imageElement = document.getElementById('layananDetailImage');
                        if (layanan.gambar) {
                            imageElement.src = `/storage/${layanan.gambar}`;
                            imageElement.style.display = 'block';
                        } else {
                            imageElement.style.display = 'none';
                        }

                        document.getElementById('layananDetailContent').style.display = 'block';
                    } else {
                        document.getElementById('layananDetailError').textContent = result.message ||
                            'Gagal memuat detail layanan';
                        document.getElementById('layananDetailError').style.display = 'block';
                    }
                })
                .catch(error => {
                    document.getElementById('layananDetailLoading').style.display = 'none';
                    document.getElementById('layananDetailError').textContent =
                        'Terjadi kesalahan saat memuat detail layanan';
                    document.getElementById('layananDetailError').style.display = 'block';
                    console.error(error);
                });
        }

        function selectService(element, layananId) {
            document.querySelectorAll('.service-card').forEach(card => {
                card.classList.remove('selected');
            });
            element.classList.add('selected');

            let hiddenInput = document.querySelector('input[name="id_layanan"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'id_layanan';
                document.getElementById('barbershop-reservation').appendChild(hiddenInput);
            }
            hiddenInput.value = layananId;

            const barbermanSection = document.getElementById('barbermanSection');
            const barbermanContainer = document.getElementById('barbermanContainer');
            barbermanSection.style.display = 'block';
            barbermanContainer.innerHTML = `
                <div class="col-12 text-center">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                    <p class="mt-2">Memuat Daftar Barberman...</p>
                </div>`;

            fetch('/get-barberman')
                .then(response => response.json())
                .then(data => {
                    barbermanContainer.innerHTML = data.map(barberman => `
                        <div class="col-md-6 mb-3">
                            <div class="service-card p-3 rounded-3 border" 
                                 onclick="selectBarberman(this, ${barberman.id})">
                                <div class="d-flex align-items-center gap-3">
                                    ${barberman.foto ? `
                                                                                                                                                                                                                                                                                                                                                                                            <div class="barberman-image rounded-circle overflow-hidden" 
                                                                                                                                                                                                                                                                                                                                                                                                 style="width: 80px; height: 80px; margin-right:15px;">
                                                                                                                                                                                                                                                                                                                                                                                                <img src="/storage/${barberman.foto}" alt="${barberman.name}" 
                                                                                                                                                                                                                                                                                                                                                                                                     class="w-100 h-100" style="object-fit: cover;">
                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                        ` : `
                                                                                                                                                                                                                                                                                                                                                                                            <div class="barberman-image rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                                                                                                                                                                                                                                                                                                                                                                 style="width: 80px; height: 80px;">
                                                                                                                                                                                                                                                                                                                                                                                                <i class="fas fa-user-tie fa-2x text-white"></i>
                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                        `}
                                    <div class="barberman-info flex-grow-1">
                                        <h5 class="mb-1">${barberman.name}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error(error);
                    barbermanContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Gagal memuat daftar barberman. Silakan coba lagi.
                            </div>
                        </div>`;
                });
        }

        function selectBarberman(element, barbermanId) {
            document.querySelectorAll('#barbermanContainer .service-card').forEach(card => {
                card.classList.remove('selected');
            });
            element.classList.add('selected');

            let hiddenInput = document.querySelector('input[name="id_barberman"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'id_barberman';
                document.getElementById('barbershop-reservation').appendChild(hiddenInput);
            }
            hiddenInput.value = barbermanId;

            const scheduleSection = document.getElementById('scheduleSection');
            scheduleSection.style.display = 'block';

            // Set minimum date to today
            const tanggalInput = document.getElementById('tanggal');
            tanggalInput.min = new Date().toISOString().split('T')[0];
            tanggalInput.value = '';

            // Clear existing time slots
            document.getElementById('timeSlots').innerHTML = '<p class="text-muted">Pilih tanggal terlebih dahulu</p>';
            document.getElementById('pay-button').style.display = 'none';

            // Add event listener for date change
            tanggalInput.addEventListener('change', function() {
                loadAvailableTimeSlots(barbermanId, this.value);
            });
        }

        function loadAvailableTimeSlots(barbermanId, date) {
            const timeSlots = document.getElementById('timeSlots');
            timeSlots.innerHTML = `
                <div class="col-12 text-center">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>Memuat jadwal tersedia...</p>
                </div>
            `;

            // Fetch barberman schedule
            fetch(`/get-barberman-schedule/${barbermanId}?tanggal=${date}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(slots => {
                    timeSlots.innerHTML = '';

                    // Check if there are any slots returned
                    if (!Array.isArray(slots) || slots.length === 0) {
                        timeSlots.innerHTML =
                            `<div class="alert alert-info">Tidak ada jadwal tersedia untuk tanggal ini.</div>`;
                        return;
                    }

                    // Create time slot elements
                    const timeSlotContainer = document.createElement('div');
                    timeSlotContainer.className = 'd-flex flex-wrap gap-2';

                    slots.forEach(slot => {
                        const timeSlotDiv = document.createElement('div');
                        timeSlotDiv.className = 'time-slot';
                        timeSlotDiv.innerHTML = `
                        <input type="radio" class="btn-check" name="id_jadwal" 
                               id="time${slot.time}" value="${slot.time}" 
                               ${!slot.available ? 'disabled' : ''}>
                        <label class="btn ${slot.available ? 'btn-outline-primary' : 'btn-danger text-white'}" 
                               for="time${slot.time}">
                            ${slot.time}
                            ${!slot.available ? '<br><small>(Terisi)</small>' : ''}
                        </label>
                    `;
                        timeSlotContainer.appendChild(timeSlotDiv);
                    });

                    timeSlots.appendChild(timeSlotContainer);

                    // Show pay button when a time slot is selected
                    document.querySelectorAll('input[name="id_jadwal"]').forEach(radio => {
                        radio.addEventListener('change', function() {
                            document.getElementById('pay-button').style.display = 'block';
                        });
                    });
                })
                .catch(error => {
                    console.error('Error fetching schedule:', error);
                    timeSlots.innerHTML = `
                    <div class="alert alert-danger">
                        Gagal memuat jadwal. Silakan coba lagi.
                        <br><small>${error.message || 'Unknown error'}</small>
                    </div>
                `;
                });
        }

        // Handle click on Pay button
        document.getElementById('pay-button').addEventListener('click', function() {
            const reservationForm = document.getElementById('barbershop-reservation');
            const formData = new FormData(reservationForm);
            const selectedDate = document.getElementById('tanggal').value;

            if (!selectedDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pilih Tanggal',
                    text: 'Silakan pilih tanggal reservasi terlebih dahulu',
                });
                return;
            }

            const checkedTime = document.querySelector('input[name="id_jadwal"]:checked');
            if (!checkedTime) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pilih Jadwal',
                    text: 'Silakan pilih jadwal reservasi terlebih dahulu',
                });
                return;
            }

            // Check if user already has a reservation on the selected date
            fetch(`/check-existing-reservation?tanggal=${selectedDate}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Reservasi Sudah Ada',
                            text: data.message,
                            confirmButtonText: 'Lanjutkan Reservasi',
                            showCancelButton: true,
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Proceed with reservation if user confirms
                                processReservation(formData, selectedDate, checkedTime);
                            }
                        });
                    } else {
                        // No existing reservation, proceed normally
                        processReservation(formData, selectedDate, checkedTime);
                    }
                })
                .catch(error => {
                    console.error('Error checking existing reservations:', error);
                    Swal.fire('Gagal',
                        'Terjadi kesalahan saat memeriksa reservasi yang ada. Silakan coba lagi.', 'error');
                });
        });

        // Function to process reservation after validation
        function processReservation(formData, selectedDate, checkedTime) {
            // Re-create date object with selected date and time
            const dateTimeString = selectedDate + 'T' + checkedTime.value + ':00';
            const selectedDateTime = new Date(dateTimeString);
            const now = new Date();
            const timeDifference = (selectedDateTime - now) / (1000 * 60 * 60); // difference in hours

            if (timeDifference < 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Waktu Reservasi Tidak Valid',
                    text: 'Reservasi harus dilakukan minimal 2 jam sebelum setelah waktu sekarang',
                });
                return;
            }

            formData.append('tanggal', selectedDate);
            formData.append('id_jadwal', checkedTime.value);

            fetch('{{ route('checkout') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    if (result.snapToken) {
                        snap.pay(result.snapToken, {
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
                                    title: 'Pembayaran Gagal',
                                    text: 'Terjadi kesalahan dalam proses pembayaran',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 2000,
                                }).then(() => {
                                    window.location.href =
                                        `/midtrans/notification?order_id=${result.order_id}&status_code=${result.status_code}&transaction_status=${result.transaction_status}`;
                                });
                            },
                            onClose: function() {
                                Swal.fire({
                                    title: 'Pembayaran Ditunda',
                                    text: 'Silahkan Ke Halaman Riwayat Reservasi Untuk Melanjutkan Pembayaran',
                                    icon: 'info',
                                    showConfirmButton: false,
                                    timer: 2000,
                                }).then(() => {
                                    window.location.href = '/pelanggan/riwayat';
                                });
                            }
                        });
                    } else if (result.error) {
                        Swal.fire('Gagal', result.error, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Gagal', 'Terjadi kesalahan saat melakukan pembayaran. Silakan coba lagi.',
                        'error');
                });
        }

        // Additional styling for time slots
        const style = document.createElement('style');
        style.textContent = `
            .time-slot {
                margin: 5px;
            }
            .btn-check:checked + .btn-outline-primary {
                background-color: #0d6efd;
                color: white;
            }
            #scheduleSection {
                animation: fadeIn 0.5s ease;
            }
            .btn-check {
                position: absolute;
                clip: rect(0,0,0,0);
                pointer-events: none;
            }
        `;
        document.head.appendChild(style);
    </script>
</x-layout>
