<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Sriwijaya</title>
    <link rel="icon" href="assets/image/logo.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Header -->
    <header class="bg-gray-100 shadow-md" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo & Title -->
            <a href="/" class="flex items-center space-x-4 hover:opacity-80 transition">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-12 w-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-800">Pelita Sriwijaya</h1>
            </a>

            <!-- Desktop Navbar -->
            <nav class="hidden md:block">
                <ul class="flex space-x-6 text-lg font-medium">
                    <li><a href="/" class="text-gray-700 hover:text-blue-600 transition duration-200">Home</a>
                    </li>
                    <li><a href="/about" class="text-gray-700 hover:text-blue-600 transition duration-200">About</a>
                    </li>
                    <li><a href="{{ route('page.ppdb.welcomePpdb') }}"
                            class="text-gray-700 hover:text-blue-600 transition duration-200">Pendaftaran Siswa</a>
                    </li>
                    <li><a href="/contact" class="text-gray-700 hover:text-blue-600 transition duration-200">Kontak</a>
                    </li>
                </ul>
            </nav>

            <!-- Hamburger Icon (Mobile) -->
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none" @click="open = !open" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden px-4 pb-4" x-show="open" x-transition>
            <ul class="flex flex-col space-y-2 text-base font-medium">
                <li><a href="/" class="text-gray-700 hover:text-blue-600">Home</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-600">About</a></li>
                <li><a href="{{ route('page.ppdb.welcomePpdb') }}" class="text-gray-700 hover:text-blue-600">PPDB
                        Online</a></li>
                <li><a href="/contact" class="text-gray-700 hover:text-blue-600">Kontak</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('main-content')
    </main>
    {{-- footer --}}
    <footer
        class="text-gray-50 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 p-10 shadow-[0_-4px_10px_rgba(0,0,0,0.1)] bg-gray-900">
        <!-- Logo & Sosial Media -->
        <div class="flex flex-col items-start space-y-4">
            <div class="flex flex-row items-center space-x-4">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-24 w-auto">
                <h1 class="text-xl font-bold">Sekolah <br>Pelita Sriwijaya</h1>
            </div>

            <div>
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
                <li><a href="/sejarah" class="hover:text-orange-600">Sejarah</a></li>
                <li><a href="/visi-misi" class="hover:text-orange-600">Visi dan Misi</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-orange-600">Kontak</a></li>
            </ul>

            <h1 class="text-lg font-bold mt-6">PENDAFTARAN</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="{{ route('page.ppdb.welcomePpdb') }}" class="hover:text-orange-600">Pendaftaran Siswa</a></li>
            </ul>
        </div>

        <!-- Berita & Peserta Didik -->
        <div class="flex flex-col items-start">
            <h1 class="text-lg font-bold">BERITA</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="/berita-sekolah" class="hover:text-orange-600">Berita Sekolah</a></li>
            </ul>

            <h1 class="text-lg font-bold mt-6">PESERTA DIDIK</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="/prestasi" class="hover:text-orange-600">Prestasi</a></li>
                <li><a href="/karya-tulis" class="hover:text-orange-600">Karya Tulis</a></li>
            </ul>
        </div>
    </footer>


</body>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</html>
