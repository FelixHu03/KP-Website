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
                    <span class="text-xl font-bold text-orange-600 sm:hidden">PPDB</span>
                </a>

                {{-- DESKTOP MENU (Hidden di Mobile) --}}
                <div class="hidden md:flex space-x-8 items-center gap-12">
                    <a href="{{ route('page.ppdb.welcomePpdb') }}"
                        class="text-gray-700 hover:text-orange-600 font-semibold transition">Home</a>
                    <a href="{{ route('page.ppdb.infoppdb') }}"
                        class="text-gray-700 hover:text-orange-600 font-semibold transition">Info</a>
                    <a href="{{ route('ppdb.register') }}"
                        class="bg-orange-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-orange-700 transition">Daftar</a>
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-orange-600 font-semibold transition">Login</a>
                </div>

                {{-- MOBILE MENU BUTTON (Hamburger) --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="text-gray-600 hover:text-orange-600 focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {{-- Icon Garis Tiga (Menu Tutup) --}}
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            {{-- Icon Silang (Menu Buka) --}}
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- MOBILE MENU DROPDOWN --}}
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-white border-t border-gray-100 shadow-lg" style="display: none;"> {{-- style display none agar tidak kedip saat load --}}

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

    <footer
        class="text-gray-50 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 p-10 shadow-[0_-4px_10px_rgba(0,0,0,0.1)] bg-gray-900">
        <!-- Logo & Sosial Media -->
        <div class="flex flex-col items-center space-y-4">
            <h1 class="text-xl font-bold">Sekolah Pelita Sriwijaya</h1>
            <div class="flex flex-row items-center space-x-4">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-24 w-auto">
            </div>

            <div class="flex flex-col items-center w-full">
                <h1 class="text-lg font-bold">FOLLOW US</h1>
                <div class="flex space-x-4 mt-4">
                    <a href="https://www.facebook.com/pelitasriwijayasch" class="hover:opacity-75">
                        <img src="{{ asset('assets/image/logo-sosial-media/facebook.png') }}" alt="Facebook"
                            class="h-10 w-10">
                    </a>
                    <a href="https://www.instagram.com/sekolahpelitasriwijaya/" class="hover:opacity-75">
                        <img src="{{ asset('assets/image/logo-sosial-media/instagram.png') }}" alt="Instagram"
                            class="h-10 w-10">
                    </a>
                    <a href="https://www.youtube.com/@SekolahpelitaSriwijaya" class="hover:opacity-75">
                        <img src="{{ asset('assets/image/logo-sosial-media/youtube.png') }}" alt="YouTube"
                            class="h-10 w-10">
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="flex flex-col items-start">
            <h1 class="text-lg font-bold">INFO KONTAK</h1>
            <div class="mt-3 space-y-5">
                <div class="flex items-start space-x-2">
                    <img src="{{ asset('assets/image/logo-contact/globe-c.png') }}" alt="globe" class="h-6 w-6">
                    <span class="pl-3">Jl. Perindustrian 2 No.1369, Kebun Bunga, Kec. Sukarami, Kota Palembang,
                        Sumatera Selatan 30961</span>
                </div>
                <div class="flex items-start space-x-2">
                    <img src="{{ asset('assets/image/logo-contact/smartphone-c.png') }}" alt="smartphone"
                        class="h-6 w-6">
                    <span class="pl-3">082375537990</span>
                </div>
                <div class="flex items-start space-x-2">
                    <img src="{{ asset('assets/image/logo-contact/email-c.png') }}" alt="Email" class="h-6 w-6">
                    <span class="pl-3">info@pelitasriwijaya.sch.id</span>
                </div>
                <div class="flex items-start space-x-2">
                    <img src="{{ asset('assets/image/logo-contact/clock-c.png') }}" alt="clock" class="h-6 w-6">
                    <span class="pl-3">Senin - Sabtu, 08.00 - 15.30</span>
                </div>
            </div>
        </div>

        <!-- Tentang -->
        <div class="flex flex-col items-start">
            <h1 class="text-lg font-bold">TENTANG</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="{{ route('about') }}" class="hover:text-orange-600">Sejarah</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-orange-600">Visi dan Misi</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-orange-600">Kontak</a></li>
            </ul>

            <h1 class="text-lg font-bold mt-6">PENDAFTARAN</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="{{ route('page.ppdb.welcomePpdb') }}" class="hover:text-orange-600">Pendaftaran
                        Siswa</a></li>
            </ul>
        </div>

        <!-- Berita & Peserta Didik -->
        <div class="flex flex-col items-start">
            <h1 class="text-lg font-bold">BERITA</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="{{ route('page.post', ['kategori' => 'berita']) }}" class="hover:text-orange-600">Berita
                        Sekolah</a></li>
            </ul>

            <h1 class="text-lg font-bold mt-6">PESERTA DIDIK</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="{{ route('page.post', ['kategori' => 'prestasi']) }}"
                        class="hover:text-orange-600">Prestasi</a></li>
                <li><a href="{{ route('page.post', ['kategori' => 'karya_tulis']) }}"
                        class="hover:text-orange-600">Karya Tulis</a></li>
            </ul>
        </div>
    </footer>
    {{-- Copyright Bar --}}
    <div class="bg-gray-900 py-4 text-center text-sm text-gray-50">
        &copy; {{ date('Y') }} Sekolah Pelita Sriwijaya. All rights reserved.
    </div>
</body>

</html>
