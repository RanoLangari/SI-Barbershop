<x-admin-layout>
    <style>
        /* Warna untuk header tabel */
        #export-table thead th {
            background-color: #0D1B2A; /* Biru gelap */
            color: white;
            text-align: left;
            padding: 10px;
        }

        /* Warna untuk body tabel */
        #export-table tbody tr {
            background-color: #f9f9f9; /* Warna latar terang */
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        /* Efek hover pada baris tabel */
        #export-table tbody tr:hover {
            background-color: #d9f2d9; /* Hijau pucat */
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
            background-color: #2D3748; /* Abu-abu gelap */
            color: #CBD5E0; /* Abu-abu terang */
        }

        body.dark #export-table tbody tr:hover {
            background-color: #4A5568; /* Abu-abu sedang */
        }

        body.dark #export-table tbody td {
            color: #E2E8F0; /* Abu-abu terang */
        }
    </style>

    <div id="content-container" class="content-container ml-64">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-bold text-gray-800">Pembayaran</h2>
            
        </div>
        <table id="export-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Nama
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Bobot Kriteria
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Action
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Flowbite</td>
                    <td>269000</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="#" class="text-blue-600 hover:text-blue-900">
                            <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2v-7M16.293 3.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-11 11a1 1 0 01-.293.207l-4 1a1 1 0 01-1.262-1.262l1-4a1 1 0 01.207-.293l11-11z"/>
                            </svg>
                        </a>
                        <!-- Delete Button -->
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">
                            <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7H5m0 0a2 2 0 012-2h10a2 2 0 012 2m-14 0h14m-6 5v6m-4-6v6m8 0a2 2 0 01-2 2H8a2 2 0 01-2-2v-7"/>
                                </svg>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-admin-layout>
