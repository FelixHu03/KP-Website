@extends('layout.ppdb')

@section('main-content')
    <!-- Hero Section -->
    <section class="w-full relative">
        <!-- Container gambar -->
        <div class="w-full h-[450px] bg-gray-300 relative overflow-hidden">
            <img src="{{ asset('assets/image/home/class.jpg') }}" alt="Gedung Sekolah"
                class="w-full h-full object-cover shadow-md"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                onload="this.nextElementSibling.style.display='none';">

            <!-- Fallback jika gambar tidak bisa dimuat -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-purple-700 flex items-center justify-center"
                style="display: none;">
                <div class="text-center text-white">
                    <div class="text-6xl mb-4">🏫</div>
                    <p class="text-sm opacity-80">Gambar tidak tersedia</p>
                </div>
            </div>
        </div>

        <!-- Overlay konten tanpa background overlay penuh -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div
                class="text-center text-white space-y-4 px-8 py-8 bg-black/40 rounded-lg backdrop-blur-sm border border-white/20 shadow-2xl">
                <h1 class="text-3xl md:text-5xl font-bold">PPDB 2026/2027</h1>
                <p class="text-lg md:text-2xl font-semibold">Tersedia Beasiswa Bebas SPP 3 s.d. 36 Bulan</p>
                <a href="{{ route('ppdb.register') }}"
                    class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-md text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl">
                    Daftar Sekarang!
                </a>
            </div>
        </div>
    </section>

    <!-- Informasi & Aksi -->
    <section class="py-12 px-4 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-teal-900 text-white p-8 rounded-lg shadow-lg space-y-4">
            <h2 class="text-xl font-bold">Sebelum mendaftar, pastikan anda sudah membaca syarat & ketentuan.</h2>
            <div class="space-y-3">
                <a href="{{ route('ppdb.register') }}"
                    class="block w-full bg-green-500 hover:bg-green-600 text-white py-2 text-center font-semibold rounded">Daftar</a>
                <a href="{{ route('login') }}"
                    class="block w-full bg-blue-500 hover:bg-blue-600 text-white py-2 text-center font-semibold rounded">Login</a>
                <a href="#"
                    class="block w-full bg-gray-500 hover:bg-gray-600 text-white py-2 text-center font-semibold rounded">Waitlist
                    2027/2028</a>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">Info PPDB Online</h2>
            <p class="text-gray-700">
                PPDB (Penerimaan Peserta Didik Baru) Online merupakan sistem yang diciptakan untuk otomasi PPDB yang
                biasanya dilaksanakan secara manual. Dengan adanya sistem ini maka calon siswa yang akan mendaftar ke
                Sekolah Pelita Sriwijaya ini diberi kemudahan untuk mendaftarkan diri.
            </p>
            <ul class="list-disc pl-5 text-gray-700 space-y-2">
                <li>PPDB 2026/2027 untuk SD Pelita Sriwijaya (usia anak minimal 6 tahun per Juli 2026)</li>
                <li>PPDB 2026/2027 untuk SMP (untuk siswa kelas 6 SD)</li>
                <li>PPDB 2026/2027 untuk SMA (untuk siswa kelas 9 SMP)</li>
            </ul>
            <div class="space-y-2 mt-4">
                <a href="#" class="block bg-gray-800 text-white text-center px-4 py-2 rounded hover:bg-gray-700">
                    Panduan Pendaftaran
                </a>
                <a href="#"
                    class="block bg-white border border-gray-400 text-center px-4 py-2 rounded hover:bg-gray-50">
                    PPDB 2026/2027 SD, SMP, SMA (Gelombang 3)
                </a>
            </div>
        </div>
    </section>
@endsection
