@extends('layout.ppdb-user')

@section('main-content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white shadow-xl rounded-2xl p-10 max-w-2xl w-full grid gap-6 text-center">
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
        </div>
    </div>
@endsection
