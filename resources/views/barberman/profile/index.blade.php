<x-admin-layout>
    <!-- Tambahkan link ke SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            max-width: 600px;
            /* Perkecil ukuran card */
        }

        .jarak {
            margin-top: 100px;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            outline: none;
        }
    </style>
    <section class="jarak">
        <div class="container mx-auto my-6 p-8 bg-white rounded-lg shadow-md">
            <h2 class="text-3xl font-bold leading-tight text-gray-900 mb-6">Edit Profile</h2>
            <form id="profileForm" action="{{ route('barberman.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                            class="form-input mt-1" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                            class="form-input mt-1" readonly>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" value="{{ Auth::user()->no_telepon }}"
                            class="form-input mt-1" required>
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}"
                            class="form-input mt-1" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="form-input mt-1">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-input mt-1">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-input" id="foto" name="foto" onchange="previewImage(event)">
                    <img id="imagePreview" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '#' }}" alt="Image Preview" class="mt-3" style="display: {{ Auth::user()->foto ? 'block' : 'none' }}; max-width: 200px; height: auto;">
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                        Profile</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Script untuk validasi -->
    <script>
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var passwordConfirmation = document.getElementById('password_confirmation').value;

            // Validasi password minimal 6 karakter jika diisi
            if (password && password.length < 6) {
                event.preventDefault(); // Mencegah submit form
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Password harus minimal 6 karakter.',
                });
                return;
            }

            // Validasi konfirmasi password
            if (password !== passwordConfirmation) {
                event.preventDefault(); // Mencegah submit form
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Password dan konfirmasi password harus sama.',
                });
                return;
            }
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- SweetAlert untuk session success tanpa redirect -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    <!-- SweetAlert untuk session error -->
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</x-admin-layout>
