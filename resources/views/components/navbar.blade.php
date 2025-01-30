<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="{{ request()->is('about') ? 'active' : '' }}"><a
                                    href="{{ url('/about') }}">About</a></li>

                            <li class="{{ request()->is('news') ? 'active' : '' }}"><a href="">Product</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('/layanan') }}">Layanan</a></li>
                                    {{-- <li><a href="{{ url('/barberman') }}">Barberman</a></li> --}}
                                    <li><a href="{{route('pelanggan.reservasi')}}">Reservasi</a></li>
                                </ul>
                            </li>

                            <li class="{{ request()->is('contact') ? 'active' : '' }}"><a
                                    href="{{ url('/kontak') }}">Contact</a></li>

                            <li><a href="{{route('login')}}">Login</a>
                            </li>
                        </ul>
                    </nav>

                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->



<style>
    .main-menu ul li.active>a {
        color: #F28123;
        /* Change this to the desired color */
    }
</style>
