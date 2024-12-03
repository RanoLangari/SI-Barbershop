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
    <div class="min-h-full">
        <main>
            <section class="min-h-screen flex items-center justify-center bg-gray-100">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" data-aos="fade-up">
                    <div class="flex justify-center mb-6">
                        <img src="path/to/logo.png" alt="Logo" class="h-16 w-16">
                    </div>
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Masuk ke Akun</h2>
                    <form id="loginform" action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 border-gray-300 rounded">
                                <label for="remember" class="ml-2 text-sm text-gray-900">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-blue-700 hover:text-blue-800">Forgot password?</a>
                        </div>
                        <button type="submit" class="w-full py-2 px-4 bg-blue-700 text-white rounded-md">Login</button>
                    </form>
                    <p class="text-center mt-4">Don't have an account? <a href="#" class="text-blue-700">Sign up</a></p>
                    <p class="text-center mt-4"><a href="{{ url('/') }}" class="text-blue-700">Back to previous page</a></p>
                </div>
            </section>
        </main>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#loginform').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Berhasil',
                                text: 'Mengalihkan ke dashboard...',
                                timer: 2000,
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: response.message || 'Terjadi kesalahan. Silakan coba lagi.',
                            });
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = 'Email atau password salah.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: errorMessage,
                        });
                    },
                });
            });
        });
    </script>
</body>
</html>
