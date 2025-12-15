<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Pelita Sriwijaya</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/png">
    
    {{-- Tambahkan Alpine.js untuk interaksi Mobile Menu --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    {{-- Navbar dengan Alpine Data --}}
    <nav class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                
                {{-- LOGO --}}
                <a href="{{ route('page.ppdb.welcomePpdb') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-12 w-auto">
                    <span class="text-xl font-bold text-orange-600 hidden sm:block">PPDB PELITA SRIWIJAYA</span>
                    <span class="text-xl font-bold text-orange-600 sm:hidden">PPDB</span> {{-- Versi pendek untuk HP --}}
                </a>

                {{-- DESKTOP MENU (Hidden di Mobile) --}}
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('page.ppdb.welcomePpdb') }}"
                        class="text-gray-700 hover:text-orange-600 font-semibold transition">Home</a>
                    <a href="{{ route('about') }}" 
                        class="text-gray-700 hover:text-orange-600 font-semibold transition">Info</a>
                    <a href="{{ route('ppdb.register') }}"
                        class="bg-orange-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-orange-700 transition">Daftar</a>
                    <a href="{{ route('login') }}" 
                        class="text-gray-700 hover:text-orange-600 font-semibold transition">Login</a>
                </div>

                {{-- MOBILE MENU BUTTON (Hamburger) --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-gray-600 hover:text-orange-600 focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {{-- Icon Garis Tiga (Menu Tutup) --}}
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            {{-- Icon Silang (Menu Buka) --}}
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- MOBILE MENU DROPDOWN --}}
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-white border-t border-gray-100 shadow-lg"
             style="display: none;"> {{-- style display none agar tidak kedip saat load --}}
            
            <div class="px-4 pt-2 pb-4 space-y-2 flex flex-col">
                <a href="{{ route('page.ppdb.welcomePpdb') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50">
                    Home
                </a>
                <a href="{{ route('about') }}" 
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50">
                    Info
                </a>
                <a href="{{ route('ppdb.register') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-orange-600 font-bold hover:bg-orange-50">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" 
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50">
                    Login
                </a>
            </div>
        </div>
    </nav>

    {{-- Isi Konten --}}
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        @yield('main-content')
    </main>

    {{-- Footer --}}
    <footer class="text-gray-50 bg-gray-900 mt-auto">
        <div class="container mx-auto px-4 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div class="flex flex-col items-start space-y-4">
                <div class="flex flex-row items-center space-x-4">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-20 w-auto">
                    <h1 class="text-xl font-bold leading-tight">Sekolah <br>Pelita Sriwijaya</h1>
                </div>
                <div>
                    <h1 class="text-lg font-bold">FOLLOW US</h1>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="hover:opacity-75 transition">
                            <img src="{{ asset('assets/image/logo-sosial-media/facebook.png') }}" alt="Facebook" class="h-8 w-8">
                        </a>
                        <a href="#" class="hover:opacity-75 transition">
                            <img src="{{ asset('assets/image/logo-sosial-media/instagram.png') }}" alt="Instagram" class="h-8 w-8">
                        </a>
                        <a href="#" class="hover:opacity-75 transition">
                            <img src="{{ asset('assets/image/logo-sosial-media/youtube.png') }}" alt="YouTube" class="h-8 w-8">
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-start">
                <h1 class="text-lg font-bold mb-4">INFO KONTAK</h1>
                <div class="space-y-4 text-sm">
                    <div class="flex items-start space-x-3">
                        <img src="{{ asset('assets/image/logo-contact/globe-c.png') }}" alt="globe" class="h-5 w-5 mt-1">
                        <span>Jl. Perindustrian 2 No.1369, Kebun Bunga, Palembang 30961</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="{{ asset('assets/image/logo-contact/smartphone-c.png') }}" alt="smartphone" class="h-5 w-5 mt-1">
                        <span>082375537990</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="{{ asset('assets/image/logo-contact/email-c.png') }}" alt="Email" class="h-5 w-5 mt-1">
                        <span>info@pelitasriwijaya.sch.id</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="{{ asset('assets/image/logo-contact/clock-c.png') }}" alt="clock" class="h-5 w-5 mt-1">
                        <span>Senin - Sabtu, 08.00 - 15.30</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-start">
                <h1 class="text-lg font-bold mb-4">TENTANG</h1>
                <ul class="space-y-2 text-sm">
                    <li><a href="/sejarah" class="hover:text-orange-400 transition">Sejarah</a></li>
                    <li><a href="/visi-misi" class="hover:text-orange-400 transition">Visi dan Misi</a></li>
                    <li><a href="/karir" class="hover:text-orange-400 transition">Karir</a></li>
                </ul>
                <h1 class="text-lg font-bold mt-6 mb-4">PENDAFTARAN</h1>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('ppdb.register') }}" class="hover:text-orange-400 transition">PPDB Online</a></li>
                </ul>
            </div>

            <div class="flex flex-col items-start">
                <h1 class="text-lg font-bold mb-4">BERITA</h1>
                <ul class="space-y-2 text-sm">
                    <li><a href="/berita-sekolah" class="hover:text-orange-400 transition">Berita Sekolah</a></li>
                </ul>
                <h1 class="text-lg font-bold mt-6 mb-4">PESERTA DIDIK</h1>
                <ul class="space-y-2 text-sm">
                    <li><a href="/prestasi" class="hover:text-orange-400 transition">Prestasi</a></li>
                    <li><a href="/karya-tulis" class="hover:text-orange-400 transition">Karya Tulis</a></li>
                </ul>
            </div>
        </div>
        
        {{-- Copyright Bar --}}
        <div class="bg-gray-950 py-4 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Sekolah Pelita Sriwijaya. All rights reserved.
        </div>
    </footer>
</body>

</html> 