<x-layout>

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Informasi Layanan</p>
                        <h1> Layanan Kami</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end breadcrumb section -->
    @php
        $layanan = \App\Models\Layanan::all();
        $kategori = \App\Models\Kategori_layanan::all();
    @endphp


    <!-- category filter -->
    <div class="container mt-100"> <!-- Reduced margin-top -->
        <div class="row justify-content-center">
            <div class="col-lg-6"> <!-- Reduced column width -->
                <div class="input-group mb-3" style="border: 2px solid #ccc; border-radius: 50px;">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="categoryFilter" style="font-size: 1.2em; border-radius: 50px 0 0 50px;"><i class="fas fa-filter"></i> Kategori</label>
                    </div>
                    <select id="categoryFilter" class="custom-select" style="font-size: 1.2em; border-radius: 0 50px 50px 0;">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- end category filter -->


    <!-- latest services -->
    <div class="latest-news mt-100 mb-150"> <!-- Reduced margin-top -->
        <div class="container">
            <div class="row" id="servicesContainer">
                @foreach ($layanan as $item)
                    <div class="col-lg-4 col-md-6 service-item" data-category="{{ $item->kategori_id }}">
                        <div class="single-latest-news">
                            <a href="#">
                                <div class="latest-news-bg"
                                    style="background-image: url({{ asset('storage/' . $item->gambar) }});"></div>
                            </a>
                            <div class="news-text-box">
                                <h3><a href="#">{{ $item->nama }}</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i> Admin</span>
                                    <span class="date"><i class="fas fa-calendar"></i>
                                        {{ $item->created_at->format('d M, Y') }}</span>
                                </p>
                                <p class="excerpt">{{ $item->detail }}</p>
                                <p class="product-price" style="font-size: 1.1em;">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('pelanggan.reservasi') }}" class="read-more-btn">reservasi <i
                                        class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end latest news -->
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            var selectedCategory = this.value;
            var services = document.querySelectorAll('.service-item');
            services.forEach(function(service) {
                if (selectedCategory === "" || service.getAttribute('data-category') === selectedCategory) {
                    service.style.display = 'block';
                    service.classList.add('fall-in');
                    setTimeout(function() {
                        service.classList.remove('fall-in');
                    }, 500);
                } else {
                    service.style.display = 'none';
                }
            });
        });
    </script>
    <style>
        .fall-in {
            animation: fallIn 0.5s ease-in-out;
        }

        @keyframes fallIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-layout>
