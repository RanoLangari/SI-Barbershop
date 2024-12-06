<nav x-data="{ activeSection: window.location.hash || '#home' }" 
    class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
       <a href="#home" @click="activeSection = '#home'; scrollToSection('#home')" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
       </a>
       <div class="flex md:order-2 space-x-3 md:space-x-4 rtl:space-x-reverse">
           <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
          <button href="{{ route('register')}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
          <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
             <span class="sr-only">Open main menu</span>
             <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
             </svg>
          </button>
       </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
         <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
           <a href="#home" 
              @click.prevent="activeSection = '#home'; scrollToSection('#home')" 
              :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#home', 'text-gray-900 dark:text-white': activeSection !== '#home' }"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Home</a>
            </li>
            <li>
           <a href="#layanan" 
              @click.prevent="activeSection = '#layanan'; scrollToSection('#layanan')" 
              :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#layanan', 'text-gray-900 dark:text-white': activeSection !== '#layanan' }"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Layanan</a>
            </li>
            <li>
           <a href="#barberman" 
              @click.prevent="activeSection = '#barberman'; scrollToSection('#barberman')" 
              :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#barberman', 'text-gray-900 dark:text-white': activeSection !== '#barberman' }"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Barberman</a>
            </li>
            @auth
            <li>
           <a href="" 
             @click.prevent="activeSection = '#pelanggan-reservasi'; scrollToSection('#pelanggan-reservasi')" 
             :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#pelanggan-reservasi', 'text-gray-900 dark:text-white': activeSection !== '#pelanggan-reservasi' }"
             class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Booking</a>
            </li>
            @endauth
            @guest
            <li>
           <a href="{{ route('login') }}" 
             :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#pelanggan-reservasi', 'text-gray-900 dark:text-white': activeSection !== '#pelanggan-reservasi' }"
             class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Booking</a>
            </li>
            @endguest
            <li>
           <a href="#tentang-kami" 
              @click.prevent="activeSection = '#tentang-kami'; scrollToSection('#tentang-kami')" 
              :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#tentang-kami', 'text-gray-900 dark:text-white': activeSection !== '#tentang-kami' }"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Tentang Kami</a>
            </li>
            <li>
           <a href="#kontak-kami" 
              @click.prevent="activeSection = '#kontak-kami'; scrollToSection('#kontak-kami')" 
              :class="{ 'text-blue-700 dark:text-blue-500': activeSection === '#kontak-kami', 'text-gray-900 dark:text-white': activeSection !== '#kontak-kami' }"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Kontak Kami</a>
            </li>
         </ul>
      </div>
    </div>
</nav>

<script>
    function scrollToSection(section) {
        const target = document.querySelector(section);
        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
        const startPosition = window.pageYOffset;
        const duration = 1000; // Durasi animasi dalam milidetik
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = ease(timeElapsed, startPosition, targetPosition - startPosition, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        // Fungsi easing untuk animasi (easeInOutQuad)
        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }
</script>
