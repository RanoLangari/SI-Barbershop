<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            @if ($success)
                <div class="mb-6">
                    <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Verifikasi Berhasil</h2>
                <p class="text-gray-600 mb-6">{{ $message }}</p>
                <a href="{{ $redirect }}"
                    class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    Continue
                </a>
            @else
                <div class="mb-6">
                    <svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Verifikasi Gagal</h2>
                <p class="text-gray-600 mb-6">{{ $message }}</p>
                <a href="{{ url('/') }}"
                    class="inline-block bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                    Kembali ke Beranda
                </a>
            @endif
        </div>
        <div class="text-center mt-6 text-gray-500 text-sm">
            &copy; {{ date('Y') }} Zeroseven Barbershop. All rights reserved.
        </div>
    </div>
</body>

</html>
