@extends('layout.ppdb')

@section('main-content')
    {{-- Hero Section & Judul --}}
    <div
        class="relative bg-orange-50 rounded-3xl overflow-hidden mb-12 py-12 px-6 text-center shadow-sm border border-orange-100">
        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-bold mb-4">
                Penerimaan Peserta Didik Baru
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                Panduan Pendaftaran <span class="text-orange-600">Online</span>
            </h1>
            <p class="text-gray-600 text-lg mb-0 leading-relaxed">
                Kami merancang proses pendaftaran yang simpel dan transparan. Ikuti 6 langkah mudah di bawah ini untuk
                bergabung dengan keluarga besar Sekolah Pelita Sriwijaya.
            </p>
        </div>
        {{-- Hiasan Background Abstrak --}}
        <div
            class="absolute top-0 left-0 w-32 h-32 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-32 h-32 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/2 translate-y-1/2">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

        {{-- Section Persiapan (Sangat Informatif) --}}
        <div class="mb-16">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 w-2 bg-orange-500 h-full"></div>
                <div class="md:flex items-start gap-6">
                    <div class="shrink-0 mb-4 md:mb-0">
                        <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center text-orange-600">
                            {{-- Icon Dokumen --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Dokumen yang Perlu Disiapkan</h3>
                        <p class="text-gray-600 text-sm mb-4">Sebelum memulai proses pendaftaran, pastikan Anda telah
                            menyiapkan file digital (foto/scan) dari dokumen berikut agar proses pengisian formulir berjalan
                            lancar:</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center space-x-2 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Kartu Keluarga (KK)</span>
                            </div>
                            <div class="flex items-center space-x-2 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Pas Foto 3x4 1 lembar
                                </span>
                            </div>
                            <div class="flex items-center space-x-2 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Akta Kelahiran</span>
                            </div>
                            <div class="flex items-center space-x-2 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">File maks. 2MB (JPG/PDF)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alur Pendaftaran (Grid Layout) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- STEP 1 --}}
            <div
                class="group bg-white rounded-xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="h-2 bg-orange-500 w-0 group-hover:w-full transition-all duration-500"></div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-700 font-bold text-lg">
                            1</div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-orange-500 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Buat Akun Orang Tua</h3>
                    <p class="text-sm text-gray-600 mb-4 h-12">Klik menu <strong>"Daftar"</strong> dan isi data diri (Nama,
                        Email, Password) untuk membuat akun.</p>
                    <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                        <img src="{{ asset('assets/image/panduanppdb/step_1.png') }}" alt="Register"
                            class="w-full h-40 object-cover object-top opacity-90 group-hover:opacity-100 transition">
                    </div>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div
                class="group bg-white rounded-xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="h-2 bg-orange-500 w-0 group-hover:w-full transition-all duration-500"></div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-700 font-bold text-lg">
                            2</div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-orange-500 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Lengkapi Profil</h3>
                    <p class="text-sm text-gray-600 mb-4 h-12">Login dan lengkapi biodata Ayah & Ibu serta nomor WhatsApp
                        yang aktif.</p>
                    <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                        <img src="{{ asset('assets/image/panduanppdb/step_2.png') }}" alt="Profile Data"
                            class="w-full h-40 object-cover object-top opacity-90 group-hover:opacity-100 transition">
                    </div>
                </div>
            </div>

            {{-- STEP 3 --}}
            <div
                class="group bg-white rounded-xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="h-2 bg-orange-500 w-0 group-hover:w-full transition-all duration-500"></div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-700 font-bold text-lg">
                            3</div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-orange-500 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Masuk Dashboard</h3>
                    <p class="text-sm text-gray-600 mb-4 h-12">Pada halaman Dashboard, klik tombol <strong>"Isi
                            Formulir"</strong> untuk memulai pendaftaran anak.</p>
                    <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                        <img src="{{ asset('assets/image/panduanppdb/step_3.png') }}" alt="Dashboard"
                            class="w-full h-40 object-cover object-top opacity-90 group-hover:opacity-100 transition">
                    </div>
                </div>
            </div>

            {{-- STEP 4 --}}
            <div
                class="group bg-white rounded-xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="h-2 bg-orange-500 w-0 group-hover:w-full transition-all duration-500"></div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-700 font-bold text-lg">
                            4</div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-orange-500 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Pilih Jenjang</h3>
                    <p class="text-sm text-gray-600 mb-4 h-12">Pilih jenjang pendidikan yang sesuai (TK, SD, atau SMP)
                        untuk melanjutkan.</p>
                    <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                        <img src="{{ asset('assets/image/panduanppdb/step_4.png') }}" alt="Pilih Jenjang"
                            class="w-full h-40 object-cover object-top opacity-90 group-hover:opacity-100 transition">
                    </div>
                </div>
            </div>

            {{-- STEP 5 --}}
            <div
                class="group bg-white rounded-xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="h-2 bg-orange-500 w-0 group-hover:w-full transition-all duration-500"></div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-700 font-bold text-lg">
                            5</div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-orange-500 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Isi Data & Upload</h3>
                    <p class="text-sm text-gray-600 mb-4 h-12">Isi lengkap data siswa, data sekolah asal, dan upload
                        dokumen (KK & Akta).</p>
                    <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                        <img src="{{ asset('assets/image/panduanppdb/step_5.png') }}" alt="Formulir"
                            class="w-full h-40 object-cover object-top opacity-90 group-hover:opacity-100 transition">
                    </div>
                </div>
            </div>

            {{-- STEP 6 --}}
            <div
                class="group bg-white rounded-xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="h-2 bg-orange-500 w-0 group-hover:w-full transition-all duration-500"></div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-700 font-bold text-lg">
                            6</div>
                        <svg class="w-6 h-6 text-gray-300 group-hover:text-orange-500 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Verifikasi & Hasil</h3>
                    <p class="text-sm text-gray-600 mb-4 h-12">Pantau menu "Riwayat Pendaftaran". Jika status
                        <strong>Lulus</strong>, silakan daftar ulang.</p>
                    <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                        <img src="{{ asset('assets/image/panduanppdb/step_6.png') }}" alt="Pengumuman"
                            class="w-full h-40 object-cover object-top opacity-90 group-hover:opacity-100 transition">
                    </div>
                </div>
            </div>

        </div>

        {{-- Final CTA --}}
        <div class="mt-20 bg-gray-900 rounded-3xl p-8 md:p-12 text-center relative overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
            </div>

            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Sudah Siap Bergabung Bersama Kami?</h2>
                <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
                    Jangan lewatkan kesempatan untuk memberikan pendidikan terbaik bagi putra-putri Anda di Sekolah Pelita
                    Sriwijaya.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('ppdb.register') }}"
                        class="px-8 py-4 bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-orange-900/50 transition transform hover:-translate-y-1">
                        Daftar Akun Sekarang
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-gray-900 transition transform hover:-translate-y-1">
                        Masuk ke Akun
                    </a>
                </div>
            </div>
        </div>

        {{-- Bantuan Footer --}}
        <div class="mt-12 text-center">
            <p class="text-gray-500 text-sm">
                Mengalami kesulitan saat mendaftar? <a href="{{ route('contact') }}"
                    class="text-orange-600 font-bold hover:underline">Hubungi Admin Kami</a>
            </p>
        </div>

    </div>
@endsection
