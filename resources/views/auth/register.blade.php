<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>SI Barbershop</title>
</head>

<body class="h-full">
    <section class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" data-aos="fade-up">
            <div class="flex justify-center mb-6">
                <img src="img/barber-logo.png" alt="Logo" style="width: 120px;">
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Daftar Akun Baru</h2>
            <form id="registerform" action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input type="number" id="no_telp" name="no_telp" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-700 text-white rounded-md">Daftar</button>
            </form>
            <p class="text-center mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-700">Masuk</a>
            </p>
            <p class="text-center mt-4"><a href="{{ url('/') }}" class="text-blue-700">Kembali ke halaman
                    sebelumnya</a></p>
        </div>
    </section>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
