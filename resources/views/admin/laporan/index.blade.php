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
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-bold text-gray-800">Laporan Keuangan</h2>
        </div>

        <div class="flex justify-end mb-4">
            <form action="" method="GET" class="flex space-x-4">
                <div>
                    <input type="date" id="minDate" name="minDate" class="form-control px-4 py-2 border rounded-md"
                        placeholder="Tanggal Mulai" value="{{ request('minDate') }}">
                </div>
                <div>
                    <input type="date" id="maxDate" name="maxDate" class="form-control px-4 py-2 border rounded-md"
                        placeholder="Tanggal Selesai" value="{{ request('maxDate') }}">
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Cari</button>
            </form>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.laporan.pdf', ['minDate' => request('minDate'), 'maxDate' => request('maxDate')]) }}"
                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Cetak Laporan</a>
        </div>

        @if ($allTransactions->isEmpty())
            <p class="text-center text-gray-500">Tidak ada data laporan untuk periode yang dipilih.</p>
        @else
            <table id="export-table" class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Kategori Layanan</th>
                        <th>Layanan</th>
                        <th>Barberman</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allTransactions as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ isset($item->is_offline) ? $item->nama_pemesan : $item->user->name }}</td>
                            <td>
                                <span
                                    class="px-2 py-1 rounded-md {{ isset($item->is_offline) ? 'bg-orange-500' : 'bg-blue-500' }} text-white">
                                    {{ isset($item->is_offline) ? 'Offline' : 'Online' }}
                                </span>
                            </td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>{{ $item->layanan->nama }}</td>
                            <td>{{ $item->barberman->name }}</td>
                            <td>Rp {{ number_format($item->layanan->harga, 0, ',', '.') }}</td>
                            <td>{{ isset($item->is_offline) ? date('d-m-Y', strtotime($item->tanggal)) : date('d-m-Y', strtotime($item->tanggal_reservasi)) }}
                            </td>
                            <td>
                                <button data-id="{{ $item->id }}"
                                    data-offline="{{ isset($item->is_offline) ? 'true' : 'false' }}"
                                    class="detail-btn bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $allTransactions->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div
            class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800 dark:text-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Detail Reservasi</h3>
                <div class="mt-2 px-7 py-3">
                    <div id="modalContent" class="text-sm text-gray-500 dark:text-gray-300">
                        <div class="flex justify-center">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                        </div>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal"
                        class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize event listeners when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all detail buttons
            document.querySelectorAll('.detail-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = parseInt(this.dataset.id);
                    const isOffline = this.dataset.offline === 'true';
                    fetchTransactionDetails(id, isOffline);
                });
            });

            // Close modal on click
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('detailModal').classList.add('hidden');
            });
        });

        function fetchTransactionDetails(id, isOffline) {
            // Display loading indicator
            document.getElementById('modalContent').innerHTML = `
                <div class="flex justify-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>
                <p class="mt-2">Loading...</p>
            `;

            // Show modal immediately with loading state
            document.getElementById('detailModal').classList.remove('hidden');

            console.log(`Fetching details for transaction ID: ${id}, isOffline: ${isOffline}`);

            // Use the route to fetch transaction details via AJAX
            fetch(`/admin/laporan/detail/${id}?is_offline=${isOffline ? 1 : 0}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Server responded with status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);

                    if (data.success) {
                        let item = data.transaction;
                        let modalContent = '';

                        if (isOffline) {
                            modalContent = `
                        <p class="text-left"><strong>Jenis Transaksi:</strong> <span class="px-2 py-1 rounded-md bg-orange-500 text-white">Offline</span></p>
                        <p class="text-left"><strong>Nama:</strong> ${item.nama_pemesan || 'N/A'}</p>
                        <p class="text-left"><strong>Kategori Layanan:</strong> ${item.kategori?.nama || 'N/A'}</p>
                        <p class="text-left"><strong>Layanan:</strong> ${item.layanan?.nama || 'N/A'}</p>
                        <p class="text-left"><strong>Barberman:</strong> ${item.barberman?.name || 'N/A'}</p>
                        <p class="text-left"><strong>Metode Pembayaran:</strong> ${item.metode_pembayaran === 'tunai' ? 'Tunai' : 'Non Tunai'}</p>
                        <p class="text-left"><strong>Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(item.layanan?.harga || 0)}</p>
                        <p class="text-left"><strong>Tanggal:</strong> ${item.tanggal ? new Date(item.tanggal).toLocaleDateString('id-ID') : 'N/A'}</p>
                        <p class="text-left"><strong>Jam:</strong> ${item.jam || 'N/A'}</p>
                    `;
                        } else {
                            modalContent = `
                        <p class="text-left"><strong>Jenis Transaksi:</strong> <span class="px-2 py-1 rounded-md bg-blue-500 text-white">Online</span></p>
                        <p class="text-left"><strong>Nama:</strong> ${item.user?.name || 'N/A'}</p>
                        <p class="text-left"><strong>Kategori Layanan:</strong> ${item.kategori?.nama || 'N/A'}</p>
                        <p class="text-left"><strong>Layanan:</strong> ${item.layanan?.nama || 'N/A'}</p>
                        <p class="text-left"><strong>Barberman:</strong> ${item.barberman?.name || 'N/A'}</p>
                        <p class="text-left"><strong>Jadwal:</strong> ${item.jadwal ? `${item.jadwal.tanggal} ${item.jadwal.jam_mulai} - ${item.jadwal.jam_selesai}` : 'N/A'}</p>
                        <p class="text-left"><strong>Pembayaran:</strong> <span class="px-2 py-1 rounded-md text-white ${item.pembayaran?.status === 'completed' ? 'bg-green-500' : 'bg-red-500'}">${item.pembayaran?.status || 'N/A'}</span></p>
                        <p class="text-left"><strong>Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(item.layanan?.harga || 0)}</p>
                        <p class="text-left"><strong>Tanggal Reservasi:</strong> ${item.tanggal_reservasi ? new Date(item.tanggal_reservasi).toLocaleDateString('id-ID') : 'N/A'}</p>
                    `;
                        }

                        document.getElementById('modalContent').innerHTML = modalContent;
                    } else {
                        document.getElementById('modalContent').innerHTML =
                            `<p class="text-red-500">Transaction not found: ${data.message || 'Unknown error'}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching transaction details:', error);
                    document.getElementById('modalContent').innerHTML =
                        `<p class="text-red-500">Error loading transaction details: ${error.message}</p>
                         <p class="text-sm mt-2">Check your controller handling for offline transactions.</p>`;
                });
        }
    </script>
</x-admin-layout>
