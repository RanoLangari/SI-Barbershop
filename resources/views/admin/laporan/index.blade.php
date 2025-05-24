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
                                <button
                                    onclick="openModal({{ $item->id }}, {{ isset($item->is_offline) ? 'true' : 'false' }})"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Reservasi</h3>
                <div class="mt-2 px-7 py-3">
                    <p id="modalContent" class="text-sm text-gray-500"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal"
                        class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, isOffline) {
            // Fetch data using AJAX or populate modal content here
            const allTransactions = @json($allTransactions);

            // Debug to console
            console.log('Looking for transaction ID:', id, 'isOffline:', isOffline);
            console.log('Available transactions:', allTransactions);

            // More robust item finding - using both id and type checking
            const item = allTransactions.find(r => {
                // Check if the IDs match and also verify if the item type matches the expected type
                return r.id === id && ((isOffline && r.is_offline) || (!isOffline && !r.is_offline));
            });

            // Check if item was found
            if (!item) {
                console.error('Transaction not found:', id);
                alert('Error: Transaction details not found.');
                return;
            }

            console.log('Found transaction:', item);

            let modalContent = '';

            try {
                if (isOffline) {
                    modalContent = 
                        <p><strong>Jenis Transaksi:</strong> <span class="px-2 py-1 rounded-md bg-orange-500 text-white">Offline</span></p>
                        <p><strong>Nama:</strong> ${item.nama_pemesan || 'N/A'}</p>
                        <p><strong>Kategori Layanan:</strong> ${item.kategori?.nama || 'N/A'}</p>
                        <p><strong>Layanan:</strong> ${item.layanan?.nama || 'N/A'}</p>
                        <p><strong>Barberman:</strong> ${item.barberman?.name || 'N/A'}</p>
                        <p><strong>Metode Pembayaran:</strong> ${item.metode_pembayaran === 'tunai' ? 'Tunai' : 'Non Tunai'}</p>
                        <p><strong>Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(item.layanan?.harga || 0)}</p>
                        <p><strong>Tanggal:</strong> ${item.tanggal ? new Date(item.tanggal).toLocaleDateString('id-ID') : 'N/A'}</p>
                        <p><strong>Jam:</strong> ${item.jam || 'N/A'}</p>
                    ;
                } else {
                    modalContent = 
                        <p><strong>Jenis Transaksi:</strong> <span class="px-2 py-1 rounded-md bg-blue-500 text-white">Online</span></p>
                        <p><strong>Nama:</strong> ${item.user?.name || 'N/A'}</p>
                        <p><strong>Kategori Layanan:</strong> ${item.kategori?.nama || 'N/A'}</p>
                        <p><strong>Layanan:</strong> ${item.layanan?.nama || 'N/A'}</p>
                        <p><strong>Barberman:</strong> ${item.barberman?.name || 'N/A'}</p>
                        <p><strong>Jadwal:</strong> ${item.jadwal ? ${item.jadwal.tanggal} ${item.jadwal.jam_mulai} - ${item.jadwal.jam_selesai} : 'N/A'}</p>
                        <p><strong>Pembayaran:</strong> <span class="px-2 py-1 rounded-md text-white ${item.pembayaran?.status === 'completed' ? 'bg-green-500' : 'bg-red-500'}">${item.pembayaran?.status || 'N/A'}</span></p>
                        <p><strong>Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(item.layanan?.harga || 0)}</p>
                        <p><strong>Tanggal Reservasi:</strong> ${item.tanggal_reservasi ? new Date(item.tanggal_reservasi).toLocaleDateString('id-ID') : 'N/A'}</p>
                    ;
                }
            } catch (error) {
                console.error('Error creating modal content:', error);
                modalContent = '<p class="text-red-500">Error loading transaction details. Please try again.</p>';
            }

            document.getElementById('modalContent').innerHTML = modalContent;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('detailModal').classList.add('hidden');
        });
    </script>
</x-admin-layout>