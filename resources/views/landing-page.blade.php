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



    <!-- testimonail-section -->
    <div class="testimonail-section mt-150 mb-150" style="background-color: #f0f0f0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="testimonial-sliders owl-carousel owl-theme">
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar1.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>Saira Hakim <span>Pelanggan Setia</span></h3>
                                <p class="testimonial-body">
                                    " ZeroSeven Barbershop memberikan pelayanan yang luar biasa. Saya selalu puas dengan
                                    hasil potongan rambut saya. "
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar2.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>David Niph <span>Pelanggan Setia</span></h3>
                                <p class="testimonial-body">
                                    " Pelayanan di ZeroSeven Barbershop sangat profesional dan ramah. Saya sangat
                                    merekomendasikan tempat ini. "
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar3.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>Jacob Sikim <span>Pelanggan Setia</span></h3>
                                <p class="testimonial-body">
                                    " Setiap kali saya datang ke ZeroSeven Barbershop, saya selalu mendapatkan hasil
                                    yang memuaskan. Tempat ini sangat direkomendasikan. "
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->

    <script>
        $(document).ready(function(){
            $(".testimonial-sliders").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 450,
                onTranslated: function(event) {
                    var items = event.item.count;
                    var item = event.item.index;
                    $('.owl-item').removeClass('animated');
                    $('.owl-item').eq(item).addClass('animated');
                }
            });
        });
    </script>

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


</x-layout>
