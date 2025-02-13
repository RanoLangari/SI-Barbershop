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
            <h2 class="text-3xl font-bold text-gray-800">Jadwal Barberman</h2>
            <!-- Modal toggle -->
            {{-- <button data-modal-target="add-jadwal-modal" data-modal-toggle="add-jadwal-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah Jadwal
            </button> --}}
        </div>
        <table id="export-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Nama Barberman
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
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
                    {{-- <th>
                        <span class="flex items-center">
                            Action
                            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($dataJadwal as $jadwal)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $jadwal->barberman->name }}
                        </td>
                        <td>{{ $jadwal->tanggal }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        {{-- <td>
                            <!-- Edit Button -->
                            <button data-modal-target="edit-jadwal-modal-{{ $jadwal->id }}"
                                data-modal-toggle="edit-jadwal-modal-{{ $jadwal->id }}"
                                class="text-blue-600 hover:text-blue-900">
                                <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 4H4a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2v-7M16.293 3.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-11 11a1 1 0 01-.293.207l-4 1a1 1 0 01-1.262-1.262l1-4a1 1 0 01.207-.293l11-11z" />
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            <button data-modal-target="delete-jadwal-modal-{{ $jadwal->id }}"
                                data-modal-toggle="delete-jadwal-modal-{{ $jadwal->id }}"
                                class="text-red-600 hover:text-red-900 ms-2">
                                <svg class="w-6 h-6 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7H5m0 0a2 2 0 012-2h10a2 2 0 012 2m-14 0h14m-6 5v6m-4-6v6m8 0a2 2 0 01-2 2H8a2 2 0 01-2-2v-7" />
                                </svg>
                            </button>
                        </td> --}}
                    </tr>

                    <!-- Edit Jadwal Modal -->
                    <div id="edit-jadwal-modal-{{ $jadwal->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Edit Jadwal
                                    </h3>
                                    <button type="button"
                                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="edit-jadwal-modal-{{ $jadwal->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-4 md:p-5">
                                    <form class="space-y-4" action="{{ route('admin.jadwal.update', $jadwal->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="id_barberman"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barberman</label>
                                            <select name="id_barberman" id="id_barberman"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                required>
                                                @foreach ($dataBarberman as $barberman)
                                                    <option value="{{ $barberman->id }}"
                                                        {{ $jadwal->id_barberman == $barberman->id ? 'selected' : '' }}>
                                                        {{ $barberman->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="tanggal"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal"
                                                value="{{ $jadwal->tanggal }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                required />
                                        </div>
                                        <div>
                                            <label for="jam_mulai"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                                                Mulai</label>
                                            <input type="time" name="jam_mulai" id="jam_mulai"
                                                value="{{ $jadwal->jam_mulai }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                required />
                                        </div>
                                        <div class="mb-4">
                                            <label for="jam_selesai"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                                                Selesai</label>
                                            <input type="time" name="jam_selesai" id="jam_selesai"
                                                value="{{ $jadwal->jam_selesai }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                required />
                                        </div>
                                        <button type="submit"
                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                                            Jadwal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Jadwal Modal -->
    <div id="add-jadwal-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Jadwal
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-jadwal-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="id_barberman"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barberman</label>
                            <select name="id_barberman" id="id_barberman"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                @foreach ($dataBarberman as $barberman)
                                    <option value="{{ $barberman->id }}">{{ $barberman->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tanggal"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="jam_mulai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="jam_selesai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                                Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah
                            Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
    </script>
</x-admin-layout>
@foreach ($dataJadwal as $jadwal)
    <!-- Delete Modal -->
    <div id="delete-jadwal-modal-{{ $jadwal->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Hapus Jadwal
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="delete-jadwal-modal-{{ $jadwal->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Apakah anda yakin ingin menghapus jadwal ini?</h3>
                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Ya, saya yakin
                        </button>
                        <button data-modal-hide="delete-jadwal-modal-{{ $jadwal->id }}" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Tidak, batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
