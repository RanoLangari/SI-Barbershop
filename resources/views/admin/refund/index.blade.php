<x-admin-layout>
    <style>
        /* Warna untuk header tabel */
        #export-table thead th {
            background-color: #0D1B2A;
            /* Biru gelap */
            color: white;
            text-align: left;
            padding: 10px;
        }

        /* Warna untuk body tabel */
        #export-table tbody tr {
            background-color: #f9f9f9;
            /* Warna latar terang */
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        /* Efek hover pada baris tabel */
        #export-table tbody tr:hover {
            background-color: #d9f2d9;
            /* Hijau pucat */
        }

        /* Warna dan padding pada sel */
        #export-table td {
            padding: 10px;
            color: #333;
        }

        /* Gaya teks untuk header */
        #export-table thead span {
            font-weight: bold;
        }

        /* Warna ikon sort */
        #export-table thead svg {
            fill: white;
        }

        /* Efek dark mode */
        body.dark #export-table thead th {
            background-color: #2D3748;
            /* Abu-abu gelap */
            color: #CBD5E0;
            /* Abu-abu terang */
        }

        body.dark #export-table tbody tr:hover {
            background-color: #4A5568;
            /* Abu-abu sedang */
        }

        body.dark #export-table tbody td {
            color: #E2E8F0;
            /* Abu-abu terang */
        }
    </style>

    <div id="content-container" class="content-container ml-64">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Data Refund</h2>
        <table id="export-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama Pemesan</th>
                    <th class="px-4 py-2">Jumlah Yang Harus Dikembalikan</th>
                    <th class="px-4 py-2">Alasan</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Bukti Transfer</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataRefund as $item)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="border px-4 py-2">{{ $item->reservasi->user->name }}</td>
                        <td class="border px-4 py-2">Rp. {{ number_format($item->pembayaran->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="border px-4 py-2">{{ $item->alasan }}</td>
                        <td class="border px-4 py-2">
                            @if ($item->status == 'pending')
                                Pending
                            @elseif ($item->status == 'success')
                                Disetujui
                            @elseif ($item->status == 'failed')
                                Ditolak
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            @if ($item->bukti)
                                <img src="{{ asset('uploads/refund/' . $item->bukti) }}" alt="Bukti Transfer"
                                    class="w-16 h-16 rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <button data-modal-target="detail-refund-modal-{{ $item->id }}"
                                data-modal-toggle="detail-refund-modal-{{ $item->id }}"
                                class="text-green-600 hover:text-green-900 ml-2">
                                <i class="fas fa-info-circle"></i> Detail ||
                            </button>
                            <button data-modal-target="edit-refund-modal-{{ $item->id }}"
                                data-modal-toggle="edit-refund-modal-{{ $item->id }}"
                                class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <!-- Detail Refund Modal -->
                            <div id="detail-refund-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
                                <div class="bg-white rounded-lg shadow-2xl w-full max-w-lg overflow-hidden">
                                    <div
                                        class="flex justify-between items-center px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-800">
                                        <h3 class="text-xl font-semibold text-white">Detail Refund</h3>
                                        <button type="button" class="text-white hover:text-gray-200 text-2xl"
                                            data-modal-hide="detail-refund-modal-{{ $item->id }}">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="px-6 py-4 space-y-3 text-gray-700 text-left">
                                        <p><strong>Nama Pemesan:</strong> {{ $item->reservasi->user->name }}</p>
                                        <p><strong>Jumlah Yang Harus Dikembalikan:</strong> Rp.
                                            {{ number_format($item->pembayaran->jumlah, 0, ',', '.') }}</p>
                                        <p><strong>Alasan:</strong> {{ $item->alasan }}</p>
                                        <p><strong>Status:</strong>
                                            @if ($item->status == 'pending')
                                                Pending
                                            @elseif ($item->status == 'success')
                                                Disetujui
                                            @elseif ($item->status == 'failed')
                                                Ditolak
                                            @endif
                                        </p>
                                        <p><strong>Merchant:</strong> {{ $item->merchant }}</p>
                                        <p><strong>Alamat Merchant:</strong> {{ $item->address_refund }}</p>
                                        <p><strong>Atas Nama:</strong> {{ $item->address_name }}</p>
                                        <p>
                                            <strong>Bukti Transfer:</strong>
                                            @if ($item->bukti)
                                                <img src="{{ asset('uploads/refund/' . $item->bukti) }}"
                                                    alt="Bukti Transfer" class="w-24 h-24 mt-2 border rounded shadow">
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                    <div class="px-6 py-4 bg-gray-100 text-right">
                                        <button type="button"
                                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                            data-modal-hide="detail-refund-modal-{{ $item->id }}">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Refund Modal -->
                    <div id="edit-refund-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                                <div class="flex justify-between items-center p-4 border-b">
                                    <h3 class="text-xl font-semibold">Edit Refund</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-900 text-2xl"
                                        data-modal-hide="edit-refund-modal-{{ $item->id }}">
                                        &times;
                                    </button>
                                </div>
                                <div class="p-4">
                                    <form action="{{ route('admin.refund.update', $item->id) }}" method="POST"
                                        id="edit-refund-form-{{ $item->id }}" class="edit-refund-form space-y-4"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="space-y-1">
                                            <label for="status-{{ $item->id }}"
                                                class="block text-sm font-medium text-gray-700">
                                                Status Refund
                                            </label>
                                            <select name="status" id="status-{{ $item->id }}"
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="pending"
                                                    {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="success"
                                                    {{ $item->status == 'success' ? 'selected' : '' }}>Disetujui
                                                </option>
                                                <option value="failed"
                                                    {{ $item->status == 'failed' ? 'selected' : '' }}>Ditolak
                                                </option>
                                            </select>
                                        </div>
                                        <div class="space-y-1 mt-4 mb-4">
                                            <label for="bukti-{{ $item->id }}"
                                                class="block text-sm font-medium text-gray-700">
                                                Bukti Transfer
                                            </label>
                                            <input type="file" name="bukti" id="bukti-{{ $item->id }}"
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            @if ($item->bukti)
                                                <img src="{{ asset('uploads/refund/' . $item->bukti) }}"
                                                    alt="Bukti Transfer" class="w-16 h-16 mt-2">
                                            @endif
                                        </div>
                                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md">
                                            Update Refund
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.edit-refund-form').on('submit', function(e) {
                e.preventDefault();
                let form = this;
                let formData = new FormData(form);

                Swal.fire({
                    title: 'Harap Tunggu',
                    text: 'Sedang memproses refund...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Refund berhasil diupdate',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan: ' + xhr.responseJSON.error,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>
</x-admin-layout>
