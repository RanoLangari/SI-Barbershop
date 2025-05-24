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
            <h2 class="text-3xl font-bold text-gray-800">Pesanan</h2>
            <!-- Modal toggle -->
            <button data-modal-target="add-order-modal" data-modal-toggle="add-order-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah Pesanan
            </button>
        </div>
        <table id="export-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Nama Pemesan
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Kategori Layanan
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Layanan
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Barberman
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Pembayaran
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Tanggal
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Jam
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Action
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nama_pemesan }}</td>
                        <td>{{ $item->kategori->nama ?? 'N/A' }}</td>
                        <td>{{ $item->layanan->nama ?? 'N/A' }}</td>
                        <td>{{ $item->barberman->name ?? 'N/A' }}</td>
                        <td>{{ $item->metode_pembayaran ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>
                            <!-- Detail Button -->
                            <button data-modal-target="detail-order-modal-{{ $item->id }}"
                                data-modal-toggle="detail-order-modal-{{ $item->id }}"
                                class="text-green-600 hover:text-green-900 me-2">
                                <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a9.5 9.5 0 11-19 0 9.5 9.5 0 0119 0z" />
                                </svg>
                            </button>
                            <!-- Detail Modal -->
                            <div id="detail-order-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Detail Pesanan
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="detail-order-modal-{{ $item->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 md:p-5">
                                            <dl class="divide-y divide-gray-200 dark:divide-gray-600">
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Nama
                                                        Pemesan
                                                    </dt>
                                                    <dd class="text-gray-900 dark:text-white">
                                                        {{ $item->nama_pemesan }}</dd>
                                                </div>
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Kategori
                                                        Layanan</dt>
                                                    <dd class="text-gray-900 dark:text-white">
                                                        {{ $item->kategori->nama ?? 'N/A' }}</dd>
                                                </div>
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Layanan
                                                    </dt>
                                                    <dd class="text-gray-900 dark:text-white">
                                                        {{ $item->layanan->nama ?? 'N/A' }}</dd>
                                                </div>
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Barberman
                                                    </dt>
                                                    <dd class="text-gray-900 dark:text-white">
                                                        {{ $item->barberman->name ?? 'N/A' }}</dd>
                                                </div>
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Metode
                                                        Pembayaran</dt>
                                                    <dd class="text-gray-900 dark:text-white">
                                                        {{ $item->metode_pembayaran ?? 'N/A' }}</dd>
                                                </div>
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Tanggal
                                                    </dt>
                                                    <dd class="text-gray-900 dark:text-white">
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                                    </dd>
                                                </div>
                                                <div class="py-2 flex justify-between">
                                                    <dt class="font-medium text-gray-700 dark:text-gray-200">Jam</dt>
                                                    <dd class="text-gray-900 dark:text-white">{{ $item->jam }}</dd>
                                                </div>
                                                @if ($item->layanan && isset($item->layanan->harga))
                                                    <div class="py-2 flex justify-between">
                                                        <dt class="font-medium text-gray-700 dark:text-gray-200">Harga
                                                            Layanan</dt>
                                                        <dd class="text-gray-900 dark:text-white">Rp
                                                            {{ number_format($item->layanan->harga, 0, ',', '.') }}
                                                        </dd>
                                                    </div>
                                                @endif
                                                @if ($item->jenis_non_tunai)
                                                    <div class="py-2 flex justify-between">
                                                        <dt class="font-medium text-gray-700 dark:text-gray-200">Jenis
                                                            Non
                                                            Tunai</dt>
                                                        <dd class="text-gray-900 dark:text-white">
                                                            {{ $item->jenis_non_tunai }}</dd>
                                                    </div>
                                                @endif
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Button -->
                            {{-- <button data-modal-target="edit-order-modal-{{ $item->id }}"
                                data-modal-toggle="edit-order-modal-{{ $item->id }}"
                                class="text-blue-600 hover:text-blue-900">
                                <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 4H4a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2v-7M16.293 3.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-11 11a1 1 0 01-.293.207l-4 1a1 1 0 01-1.262-1.262l1-4a1 1 0 01.207-.293l11-11z" />
                                </svg>
                            </button> --}}

                            <!-- Edit Modal -->
                            <div id="edit-order-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Edit Pesanan
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="edit-order-modal-{{ $item->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 md:p-5">
                                            <form class="space-y-4"
                                                action="{{ route('admin.order.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div>
                                                    <label for="nama_pemesan-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                        Pemesan</label>
                                                    <input type="text" name="nama_pemesan"
                                                        id="nama_pemesan-{{ $item->id }}"
                                                        value="{{ $item->nama_pemesan }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                </div>
                                                <div>
                                                    <label for="kategori_id-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                                    <select name="kategori_id" id="kategori_id-{{ $item->id }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach ($kategoris as $kat)
                                                            <option value="{{ $kat->id }}"
                                                                {{ old('kategori_id', $item->kategori_id) == $kat->id ? 'selected' : '' }}>
                                                                {{ $kat->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="id_layanan-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Layanan</label>
                                                    <select name="id_layanan" id="id_layanan-{{ $item->id }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="">-- Pilih Layanan --</option>
                                                        @foreach ($layanans as $layanan)
                                                            <option value="{{ $layanan->id }}"
                                                                {{ old('id_layanan', $item->id_layanan) == $layanan->id ? 'selected' : '' }}>
                                                                {{ $layanan->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="id_barberman-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barberman</label>
                                                    <select name="id_barberman" id="id_barberman-{{ $item->id }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        @foreach ($barbermen as $barber)
                                                            <option value="{{ $barber->id }}"
                                                                {{ $item->id_barberman == $barber->id ? 'selected' : '' }}>
                                                                {{ $barber->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="metode_pembayaran-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode
                                                        Pembayaran</label>
                                                    <select name="metode_pembayaran"
                                                        id="metode_pembayaran-{{ $item->id }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="tunai"
                                                            {{ $item->metode_pembayaran == 'tunai' ? 'selected' : '' }}>
                                                            Tunai</option>
                                                        <option value="non_tunai"
                                                            {{ $item->metode_pembayaran == 'non_tunai' ? 'selected' : '' }}>
                                                            Non Tunai</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="tanggal-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                                    <input type="date" name="tanggal"
                                                        id="tanggal-{{ $item->id }}"
                                                        value="{{ $item->tanggal }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                </div>
                                                <div>
                                                    <label for="jam-{{ $item->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam</label>
                                                    <input type="time" name="jam"
                                                        id="jam-{{ $item->id }}" value="{{ $item->jam }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                </div>
                                                <button type="submit"
                                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                                                    Pesanan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Button -->
                            <button data-modal-target="delete-order-modal-{{ $item->id }}"
                                data-modal-toggle="delete-order-modal-{{ $item->id }}"
                                class="text-red-600 hover:text-red-900 ms-2">
                                <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7H5m0 0a2 2 0 012-2h10a2 2 0 012 2m-14 0h14m-6 5v6m-4-6v6m8 0a2 2 0 01-2 2H8a2 2 0 01-2-2v-7" />
                                </svg>
                            </button>

                            <!-- Delete Modal -->
                            <div id="delete-order-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Hapus Pesanan
                                            </h3>
                                            <button type="button"
                                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="delete-order-modal-{{ $item->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                Apakah anda yakin ingin menghapus pesanan ini?</h3>
                                            <form action="{{ route('admin.order.destroy', $item->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                    Ya, saya yakin
                                                </button>
                                                <button data-modal-hide="delete-order-modal-{{ $item->id }}"
                                                    type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Tidak, batal
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Backdrop -->
    <div id="add-order-backdrop" class="hidden bg-gray-100/50 dark:bg-gray-100/80 fixed inset-0 z-40">
    </div>

    <!-- Add Order Modal -->
    <div id="add-order-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Pesanan
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-order-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('admin.order.store') }}" method="POST"
                        id="add-order-form">
                        @csrf
                        <div>
                            <label for="nama_pemesan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Pemesan</label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Nama Pemesan" required />
                        </div>
                        <div>
                            <label for="kategori_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select name="kategori_id" id="kategori_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="id_layanan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Layanan</label>
                            <select name="id_layanan" id="id_layanan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach ($layanans as $layanan)
                                    <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga }}"
                                        data-kategori-id="{{ $layanan->kategori_id }}">
                                        {{ $layanan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="id_barberman"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barberman</label>
                            <select name="id_barberman" id="id_barberman"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                                <option value="">-- Pilih Barberman --</option>
                                @foreach ($barbermen as $barber)
                                    <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="metode_pembayaran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode
                                Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="tunai">Tunai</option>
                                <option value="non_tunai">Non Tunai</option>
                            </select>
                        </div>
                        <div id="non_tunai_options" style="display:none;">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Non
                                Tunai</label>
                            <select name="jenis_non_tunai" id="jenis_non_tunai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>
                        <div id="harga_layanan_field" style="display:none;">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                Layanan</label>
                            <input type="text" id="harga_layanan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                readonly>
                        </div>
                        <div id="harga_layanan_non_tunai_field" style="display:none;">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                Layanan</label>
                            <input type="text" id="harga_layanan_non_tunai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                readonly>
                        </div>
                        <div id="midtrans_field" style="display:none;">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pembayaran Non
                                Tunai</label>
                            <div
                                class="bg-gray-100 border border-gray-300 rounded-lg p-3 text-center text-gray-700 dark:bg-gray-600 dark:text-white">
                                <span id="midtrans_placeholder">Midtrans Payment akan muncul di sini.</span>
                            </div>
                        </div>
                        <div>
                            <label for="tanggal"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <div>
                            <label for="jam"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam</label>
                            <input type="time" name="jam" id="jam"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah
                            Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show backdrop when modal opens
        document.querySelectorAll('[data-modal-target="add-order-modal"]').forEach(button => {
            button.addEventListener('click', () => {
                backdrop.classList.remove('hidden');
                backdrop.classList.add('block');
            });
        });

        // Hide backdrop when modal closes
        document.querySelectorAll('[data-modal-hide="add-order-modal"]').forEach(button => {
            button.addEventListener('click', () => {
                backdrop.classList.remove('block');
                backdrop.classList.add('hidden');
            });
        });

        function showLoader() {
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        @if (session('success'))
            showLoader();
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1000);
        @endif

        @if (session('error'))
            showLoader();
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1000);
        @endif

        @if (session('update_success'))
            showLoader();
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Update Berhasil',
                    text: '{{ session('update_success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1000);
        @endif

        @if (session('update_error'))
            showLoader();
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Gagal',
                    text: '{{ session('update_error') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1000);
        @endif

        @if (session('delete_success'))
            showLoader();
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Hapus Berhasil',
                    text: '{{ session('delete_success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1000);
        @endif

        @if (session('delete_error'))
            showLoader();
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Hapus Gagal',
                    text: '{{ session('delete_error') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 1000);
        @endif

        // Tambahan untuk handle metode pembayaran dan harga layanan
        const metodePembayaran = document.getElementById('metode_pembayaran');
        const hargaLayananField = document.getElementById('harga_layanan_field');
        const hargaLayananInput = document.getElementById('harga_layanan');
        const hargaLayananNonTunaiField = document.getElementById('harga_layanan_non_tunai_field');
        const hargaLayananNonTunaiInput = document.getElementById('harga_layanan_non_tunai');
        const layananSelect = document.getElementById('id_layanan');
        const nonTunaiOptions = document.getElementById('non_tunai_options');
        const jenisNonTunai = document.getElementById('jenis_non_tunai');

        function updateHargaLayanan() {
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            const harga = selectedOption ? selectedOption.getAttribute('data-harga') : '';
            hargaLayananInput.value = harga ? 'Rp ' + parseInt(harga).toLocaleString('id-ID') : '';
            hargaLayananNonTunaiInput.value = harga ? 'Rp ' + parseInt(harga).toLocaleString('id-ID') : '';
        }

        metodePembayaran.addEventListener('change', function() {
            if (this.value === 'tunai') {
                hargaLayananField.style.display = 'block';
                hargaLayananNonTunaiField.style.display = 'none';
                nonTunaiOptions.style.display = 'none';
                updateHargaLayanan();
            } else if (this.value === 'non_tunai') {
                hargaLayananField.style.display = 'none';
                hargaLayananNonTunaiField.style.display = 'block';
                nonTunaiOptions.style.display = 'block';
                jenisNonTunai.value = '';
                updateHargaLayanan();
            } else {
                hargaLayananField.style.display = 'none';
                hargaLayananNonTunaiField.style.display = 'none';
                nonTunaiOptions.style.display = 'none';
            }
        });

        jenisNonTunai.addEventListener('change', function() {
            // Tidak perlu aksi tambahan, hanya placeholder jika ingin aksi khusus
        });

        layananSelect.addEventListener('change', function() {
            updateHargaLayanan();
        });

        // Filter layanan berdasarkan kategori
        const kategoriSelect = document.getElementById('kategori_id');
        // Simpan semua option layanan (deep clone agar tidak hilang saat di-append)
        const layananOptions = Array.from(layananSelect.options).map(opt => opt.cloneNode(true));

        kategoriSelect.addEventListener('change', function() {
            const kategoriId = this.value;
            layananSelect.innerHTML = '';
            layananOptions.forEach(option => {
                if (option.value === "" || option.getAttribute('data-kategori-id') === kategoriId) {
                    layananSelect.appendChild(option.cloneNode(true));
                }
            });
            // Reset harga layanan jika ada
            if (typeof updateHargaLayanan === 'function') updateHargaLayanan();
        });
    </script>

</x-admin-layout>
