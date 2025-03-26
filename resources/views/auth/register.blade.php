<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SI Barbershop - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-full">
    <div
        class="min-h-screen bg-gray-50 dark:bg-black dark:text-white/50 flex flex-col items-center justify-center relative">
        <!-- Background Pattern -->
        <img id="background" class="absolute -left-20 top-0 max-w-[877px] opacity-30 dark:opacity-20"
            src="https://laravel.com/assets/img/welcome/background.svg" alt="Background Pattern" />

        <div class="relative w-full max-w-md px-6 py-10 flex flex-col items-center justify-center">
            <!-- Logo Header -->
            <div class="flex justify-center items-center mb-6 relative z-10">
                <div
                    class="flex size-16 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 mb-4 shadow-lg">
                    <img src="img/barber-logo.png" alt="Logo" class="w-12 h-12">
                </div>
            </div>

            <!-- Register Card -->
            <div
                class="w-full bg-white dark:bg-zinc-900 rounded-lg shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] p-8 ring-1 ring-white/[0.05] dark:ring-zinc-800 relative z-10">
                <h2 class="text-2xl font-semibold text-center text-black dark:text-white mb-6">Daftar Akun Baru</h2>

                <form id="registerform" action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-black/70 dark:text-white/70">Nama</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-3 mt-1 border border-gray-200 dark:border-zinc-700 rounded-md bg-white dark:bg-zinc-800 text-black dark:text-white focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-black/70 dark:text-white/70">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-3 mt-1 border border-gray-200 dark:border-zinc-700 rounded-md bg-white dark:bg-zinc-800 text-black dark:text-white focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-black/70 dark:text-white/70">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 mt-1 border border-gray-200 dark:border-zinc-700 rounded-md bg-white dark:bg-zinc-800 text-black dark:text-white focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="no_telepon" class="block text-sm font-medium text-black/70 dark:text-white/70">No.
                            Telepon</label>
                        <input type="number" id="no_telepon" name="no_telepon"
                            class="w-full px-4 py-3 mt-1 border border-gray-200 dark:border-zinc-700 rounded-md bg-white dark:bg-zinc-800 text-black dark:text-white focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="alamat"
                            class="block text-sm font-medium text-black/70 dark:text-white/70">Alamat</label>
                        <input type="text" id="alamat" name="alamat"
                            class="w-full px-4 py-3 mt-1 border border-gray-200 dark:border-zinc-700 rounded-md bg-white dark:bg-zinc-800 text-black dark:text-white focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 bg-[#FF2D20] hover:bg-[#FF2D20]/90 text-white rounded-md transition duration-300 focus-visible:ring-1 focus-visible:ring-white focus:outline-none shadow-md">
                        Daftar
                    </button>
                </form>

                <div class="mt-6 text-center space-y-4">
                    <p class="text-black/50 dark:text-white/50 text-sm">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            class="text-[#FF2D20] hover:text-[#FF2D20]/80 transition duration-300 focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none">
                            Masuk
                        </a>
                    </p>
                    <p class="text-black/50 dark:text-white/50 text-sm">
                        <a href="{{ url('/') }}"
                            class="text-[#FF2D20] hover:text-[#FF2D20]/80 transition duration-300 focus-visible:ring-1 focus-visible:ring-[#FF2D20] focus:outline-none">
                            Kembali ke halaman utama
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-black/40 dark:text-white/40">
                SI Barbershop &copy; {{ date('Y') }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#registerform').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Harap Tunggu',
                    text: 'Sedang memproses registrasi...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil',
                                text: 'Email verifikasi telah dikirim. Silakan cek email Anda.',
                                timer: 2000,
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Registrasi Gagal',
                                text: response.message ||
                                    'Terjadi kesalahan. Silakan coba lagi.',
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal',
                            text: errorMessage,
                        });
                    },
                });
            });
        });
    </script>
</body>

</html>
