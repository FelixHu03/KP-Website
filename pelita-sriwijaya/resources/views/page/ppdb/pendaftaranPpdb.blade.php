@extends('layout.ppdb-user')

@section('main-content')
    <div class="min-h-screen bg-gray-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <a href="{{ route('ppdb-online.index') }}"
                class="inline-flex items-center text-gray-700 hover:text-orange-600 transition font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Halaman Utama
            </a>
        </div>

        <div class="flex items-center justify-center p-6">
            <div class="bg-white shadow-xl rounded-2xl p-10 max-w-2xl w-full">
                <div class="grid gap-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Pendaftaran PPDB Online</h2>

                    <p class="text-gray-600">
                        Selamat datang di halaman pendaftaran PPDB Online Sekolah Pelita Sriwijaya.
                        Silakan klik tombol di bawah untuk memulai proses pendaftaran.
                    </p>

                    <p class="text-gray-700 font-medium">Mulai Pendaftaran</p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                        <a href="{{ route('ppdb-online.formulir', ['jenjang' => 'TK']) }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                            Daftar TK
                        </a>
                        <a href="{{ route('ppdb-online.formulir', ['jenjang' => 'SD']) }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                            Daftar SD
                        </a>
                        <a href="{{ route('ppdb-online.formulir', ['jenjang' => 'SMP']) }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                            Daftar SMP
                        </a>
                    </div>
                </div> </div> </div>

    </div>
@endsection