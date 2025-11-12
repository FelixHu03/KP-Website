<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PPDB Pelita Sriwijaya')</title>

    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/png">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-white shadow-md">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('ppdb-online.index') }}" class="text-2xl font-bold text-orange-600">
                        Dashboard PPDB
                    </a>
                </div>

                <div class="ml-4 flex items-center">
                    <div x-data="{ open: false }" class="relative ml-3">
                        <div>
                            <button @click="open = !open"
                                class="flex text-sm bg-gray-200 rounded-full w-10 h-10 items-center justify-center text-gray-500 focus:outline-none hover:bg-gray-300 transition"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Buka menu</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </button>
                        </div>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">

                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ Auth::guard('ppdb')->user()->nama_lengkap }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ Auth::guard('ppdb')->user()->email }}
                                </p>
                            </div>

                            <div class="py-1" role="none">
                                <a href="{{ route('ppdb-online.pendaftaran') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1">
                                    Isi Formulir
                                </a>
                                <a href="{{ route('ppdb.data-orangtua.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1">
                                    Ubah Data Orang Tua
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem" tabindex="-1">
                                    Riwayat Pendaftaran
                                </a>
                            </div>

                            <div class="py-1 border-t border-gray-200" role="none">
                                <form method="POST" action="{{ route('logout') }}" role="menuitem" tabindex="-1">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Logout/Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('main-content')
    </main>
    {{-- footer --}}
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
                <li><a href="/sejarah" class="hover:text-orange-600">Sejarah</a></li>
                <li><a href="/visi-misi" class="hover:text-orange-600">Visi dan Misi</a></li>
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
