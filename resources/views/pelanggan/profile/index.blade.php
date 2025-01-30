<x-layout>
    <!-- Tambahkan link ke SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Edit your profile</p>
                        <h1>Edit Profile</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Edit Profile</h2>
                        <p>Update your profile information below.</p>
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form id="profileForm" action="{{ route('pelanggan.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <p>
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" placeholder="Name" required>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" placeholder="Email" required>
                            </p>
                            <p>
                                <input type="text" name="no_telepon" id="no_telepon" value="{{ Auth::user()->no_telepon }}" placeholder="No Telepon" required>
                                <input type="text" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}" placeholder="Alamat" required>
                            </p>
                            <p>
                                <input type="password" name="password" id="password" placeholder="Password" style="width: 49%; display: inline-block; height: 40px;">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" style="width: 49%; display: inline-block; height: 40px;">
                            </p>
                            <p>
                                <input type="file" id="foto" name="foto" onchange="previewImage(event)">
                                <img id="imagePreview" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '#' }}" alt="Image Preview" class="mt-3 rounded-md shadow-md" style="display: {{ Auth::user()->foto ? 'block' : 'none' }}; max-width: 200px; height: auto;">
                            </p>
                            <p><input type="submit" value="Update Profile"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
</x-layout>
