<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Pelita Sriwijaya</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Jika pakai Vite --}}
</head>

<body class="bg-white text-gray-900">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md border-b border-gray-200">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('page.ppdb.welcomePpdb') }}" class="flex items-center space-x-3">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-12 w-auto">
                <span class="text-xl font-bold text-blue-800">PPDB PELITA SRIWIJAYA</span>
            </a>

            <div class="space-x-6 hidden md:flex">
                <a href="{{ route('page.ppdb.welcomePpdb') }}"
                    class="text-gray-700 hover:text-blue-600 font-semibold">Home</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Info</a>
                <a href="{{ route('ppdb.register') }}"
                    class="text-gray-700 hover:text-blue-600 font-semibold">Daftar</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Login</a>
            </div>
        </div>
    </nav>

    {{-- Isi Konten --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('main-content')
    </main>

    {{-- Footer --}}
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
                    <a href="#" class="hover:opacity-75">
                        <img src="{{ asset('assets/image/logo-sosial-media/facebook.png') }}" alt="Facebook"
                            class="h-10 w-10">
                    </a>
                    <a href="#" class="hover:opacity-75">
                        <img src="{{ asset('assets/image/logo-sosial-media/instagram.png') }}" alt="Instagram"
                            class="h-10 w-10">
                    </a>
                    <a href="#" class="hover:opacity-75">
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
                <li><a href="/karir" class="hover:text-orange-600">Karir</a></li>
            </ul>
            <h1 class="text-lg font-bold mt-6">Pendaftaran</h1>
            <ul class="list-disc list-inside marker:text-orange-500 mt-3 space-y-2">
                <li><a href="{{ route('ppdb.register') }}" class="hover:text-orange-600">PPDB Online</a></li>
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

</html>
