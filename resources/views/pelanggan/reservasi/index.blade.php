<x-layout>

<div class="bg-white shadow-lg rounded-lg p-8 reservasi-modal">
    <div class="border-b pb-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Reservasi</h2>
    </div>
    <div>
        <form action="" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label for="reservasi-nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-nama" name="nama" required>
                </div>
                <div>
                    <label for="reservasi-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-email" name="email" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label for="reservasi-no_telp" class="block text-sm font-medium text-gray-700">No Telp</label>
                    <input type="text" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-no_telp" name="no_telp" required>
                </div>
                <div>
                    <label for="reservasi-layanan" class="block text-sm font-medium text-gray-700">Layanan</label>
                    <input type="text" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-layanan" name="layanan" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label for="reservasi-barberman" class="block text-sm font-medium text-gray-700">Barberman</label>
                    <input type="text" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-barberman" name="barberman" required>
                </div>
                <div>
                    <label for="reservasi-tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-tanggal" name="tanggal" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label for="reservasi-jam" class="block text-sm font-medium text-gray-700">Jam</label>
                    <input type="time" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-jam" name="jam" required>
                </div>
                <div>
                    <label for="reservasi-harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="reservasi-harga" name="harga" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
        </form>
    </div>
</div>

</x-layout>
