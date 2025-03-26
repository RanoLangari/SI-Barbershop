<x-layout>



    <!-- hero area -->
    <div class="hero-area hero-bg" style="height: 100vh;">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <p class="subtitle">ZeroSeven Barbershop</p>
                            <h1>Selamat Datang </h1>
                            <div class="hero-btns">
                                <a href="{{ route('pelanggan.reservasi') }}" class="boxed-btn">Reservasi</a>
                                <a href="contact.html" class="bordered-btn">Kontak Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero area -->



    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Layanan</span> Kami</h3>
                        <p>Kami menyediakan layanan terbaik untuk perawatan rambut dan penampilan Anda. Percayakan gaya
                            rambut Anda kepada kami.</p>
                    </div>
                </div>
            </div>

            @php $kategori = \App\Models\Kategori_layanan::with('layanan')->get(); @endphp
            <div class="row">
                @foreach ($kategori as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item" style="height: 100%;">
                            <div class="product-image" style="height: 400px; overflow: hidden;">
                                <a href="#"><img src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama }}"
                                        style="width: 100%; height: 100%; object-fit: cover;"></a>
                            </div>
                            <h3>{{ $item->nama }}</h3>
                            <p class="product-price">{{ $item->deskripsi }}</p>
                            <a href="{{ url('/layanan') }}" class="boxed-btn mt-3">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->





    <!-- advertisement section -->
    <div class="abt-section mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="abt-bg">
                        <a href="https://www.youtube.com/watch?v=xmTq_zWdXSM" class="video-play-btn popup-youtube"><i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="abt-text">
                        <p class="top-sub">Sejak Tahun 1999</p>
                        <h2>Kami adalah <span class="orange-text">ZeroSeven Barbershop</span></h2>
                        <p>ZeroSeven Barbershop telah berdiri sejak tahun 1999, memberikan pelayanan terbaik dalam
                            perawatan rambut dan penampilan. Kami selalu berkomitmen untuk memberikan pengalaman yang
                            memuaskan bagi setiap pelanggan.</p>
                        <p>Dengan tim profesional dan berpengalaman, kami siap membantu Anda mendapatkan gaya rambut
                            yang sesuai dengan keinginan Anda. Kami menggunakan produk berkualitas tinggi untuk
                            memastikan hasil yang terbaik.</p>
                        <a href="{{ url('/about') }}" class="boxed-btn mt-4">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end advertisement section -->


    <!-- layanan section -->
    <div class="layanan-section pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Layanan</span> Kami</h3>
                        <p>Kami menyediakan layanan terbaik untuk perawatan rambut dan penampilan Anda. Percayakan gaya
                            rambut Anda kepada kami.</p>
                    </div>
                </div>
            </div>

            @php $layanan = \App\Models\Layanan::take(3)->get(); @endphp
            <div class="row">
                @foreach ($layanan as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item" style="height: 100%;">
                            <div class="product-image" style="height: 200px; overflow: hidden;">
                                <a href="#"><img src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama }}"
                                        style="width: 100%; height: 100%; object-fit: cover;"></a>
                            </div>
                            <h3>{{ $item->nama }}</h3>
                            <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <a href="{{ url('/layanan') }}" class="boxed-btn mt-3">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end layanan section -->

    <!-- testimonial section -->
    <div class="testimonial-section py-5" style="background-color: #f7f7f7;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center mb-5">
                    <div class="section-title">
                        <h3><span class="orange-text">Ulasan</span> Pelanggan</h3>
                        <p>Apa yang dikatakan pelanggan tentang pengalaman mereka bersama kami</p>
                    </div>
                </div>
            </div>
            
            @if (isset($ulasanData) && $ulasanData->count() > 0)
                <div class="testimonial-slider">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="carousel-inner">
                            @foreach ($ulasanData as $index => $ulasan)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="testimonial-card mx-auto" style="max-width: 700px;">
                                        <div class="bg-white shadow rounded p-5 position-relative">
                                            <div class="quote-icon position-absolute" style="top: 20px; left: 20px; opacity: 0.1">
                                                <i class="fas fa-quote-left fa-4x text-warning"></i>
                                            </div>
                                            <div class="text-center mb-4">
                                                <div class="mx-auto mb-4">
                                                    @if ($ulasan->user && $ulasan->user->foto)
                                                        <img src="{{ asset('storage/' . $ulasan->user->foto) }}" alt="{{ $ulasan->user->name }}" 
                                                            class="rounded-circle border border-3 border-warning shadow" style="width: 100px; height: 100px; object-fit: cover;">
                                                    @else
                                                        <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center mx-auto border border-3 border-warning shadow" 
                                                            style="width: 100px; height: 100px; background: linear-gradient(45deg, #f9a825, #ff8f00);">
                                                            <i class="fa fa-user fa-3x text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <h4 class="mb-1 fw-bold">{{ $ulasan->user ? $ulasan->user->name : 'Pengguna' }}</h4>
                                                <small class="text-muted">{{ $ulasan->created_at->format('d M Y') }}</small>
                                            </div>
                                            <div class="testimonial-text text-center mb-3">
                                                <p class="fs-5 fst-italic">"{{ $ulasan->ulasan }}"</p>
                                                <div class="rating mt-2">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="fas fa-star {{ $i < ($ulasan->rating ?? 5) ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="carousel-indicators position-relative mt-4">
                            @foreach ($ulasanData as $index => $ulasan)
                                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                    aria-label="Slide {{ $index + 1 }}" style="width: 12px; height: 12px; border-radius: 50%; background-color: #f9a825;"></button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5 bg-white shadow rounded">
                    <i class="far fa-comment-dots fa-3x mb-3 text-muted"></i>
                    <p class="mb-0">Belum ada ulasan dari pelanggan.</p>
                </div>
            @endif
        </div>
    </div>
    <!-- end testimonial section -->

</x-layout>
