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
            <h2 class="text-3xl font-bold text-gray-800">Data Jadwal Barberman</h2>
        </div>
        <table id="export-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            No
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Nama Pelanggan
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Tanggal
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Jam Mulai
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Jam Selesai
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataJadwal as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index + 1 }}</td>
                        <td>{{ $item->customer_name }}</td> <!-- Display customer's name -->
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
