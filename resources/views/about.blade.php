<x-layout>

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Informasi Barbershop Kami</p>
                        <h1>Tentang Kami</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- featured section -->
    <div class="feature-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="featured-text">
                        <h2 class="pb-3">Mengapa <span class="orange-text">ZeroSeven</span></h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Layanan Rumah</h3>
                                        <p>Kami menyediakan layanan rumah untuk kenyamanan Anda, memastikan Anda
                                            mendapatkan potongan rambut terbaik di depan pintu Anda.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Harga Terbaik</h3>
                                        <p>Kami menawarkan harga yang kompetitif untuk semua layanan kami tanpa
                                            mengorbankan kualitas.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Gaya Kustom</h3>
                                        <p>Barber kami terampil dalam menciptakan gaya kustom yang disesuaikan dengan
                                            preferensi Anda.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Janji Temu Cepat</h3>
                                        <p>Pesan janji temu Anda dengan cepat dan mudah melalui sistem online kami.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- end featured section -->

    @php
    $barberman = \App\Models\User::where('role', 'barberman')->get();
    @endphp

    <!-- team section -->
    <div class="mt-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Tim <span class="orange-text">ZeroSeven</span></h3>
                        <p>Kami adalah tim profesional yang berdedikasi untuk memberikan layanan terbaik dan gaya rambut
                            yang sesuai dengan keinginan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($barberman as $barber)
                <div class="col-lg-4 col-md-6">
                    <div class="single-team-item">
                        <div class="team-bg"
                            style="background-image: url('{{ $barber->foto ? Storage::url($barber->foto) : 'https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500' }}');">
                        </div>
                        <h4>{{ $barber->name }} <span>Barberman</span></h4>
                        <!-- <ul class="social-link-team">
                                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            </ul> -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end team section -->

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
                                    <div class="quote-icon position-absolute"
                                        style="top: 20px; left: 20px; opacity: 0.1">
                                        <i class="fas fa-quote-left fa-4x text-warning"></i>
                                    </div>
                                    <div class="text-center mb-4">
                                        <div class="mx-auto mb-4">
                                            @if ($ulasan->user && $ulasan->user->foto)
                                            <img src="{{ asset('storage/' . $ulasan->user->foto) }}"
                                                alt="{{ $ulasan->user->name }}"
                                                class="rounded-circle border border-3 border-warning shadow"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                            <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center mx-auto border border-3 border-warning shadow"
                                                style="width: 100px; height: 100px; background: linear-gradient(45deg, #f9a825, #ff8f00);">
                                                <i class="fa fa-user fa-3x text-white"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <h4 class="mb-1 fw-bold">
                                            {{ $ulasan->user ? $ulasan->user->name : 'Pengguna' }}</h4>
                                        <small class="text-muted">{{ $ulasan->created_at->format('d M Y') }}</small>
                                    </div>
                                    <div class="testimonial-text text-center mb-3">
                                        <p class="fs-5 fst-italic">"{{ $ulasan->ulasan }}"</p>
                                        <div class="rating mt-2">
                                            @for ($i = 0; $i < 5; $i++) <i
                                                class="fas fa-star {{ $i < ($ulasan->rating ?? 5) ? 'text-warning' : 'text-muted' }}">
                                                </i>
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
                            class="{{ $index === 0 ? 'active' : '' }}"
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"
                            style="width: 12px; height: 12px; border-radius: 50%; background-color: #f9a825;"></button>
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