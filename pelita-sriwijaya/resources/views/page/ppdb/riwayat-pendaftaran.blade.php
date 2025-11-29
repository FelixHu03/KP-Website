@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-gray-50 shadow-md rounded-lg p-6">
        <div class="max-w-5xl mx-auto">

            <div class="border-b pb-4 mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Riwayat Pendaftaran Calon Siswa
                </h2>
                <p class="text-gray-600 mt-1">
                    Berikut adalah daftar semua calon siswa yang telah Anda daftarkan. Klik pada salah satu nama untuk
                    melihat detail lengkap.
                </p>
            </div>

            <div class="space-y-4">
                @forelse ($riwayatList as $siswa)
                    {{-- Setiap item adalah link ke halaman detail --}}
                    <a href="{{ route('ppdb.riwayat.detail', $siswa->id) }}"
                        class="block p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:shadow-md transition-all">

                        <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                            <div>
                                <h3 class="text-xl font-bold text-blue-600 hover:underline">{{ $siswa->namalengkap }}</h3>
                                <p class="text-gray-700 mt-1">
                                    <strong class="font-medium">NIK:</strong> {{ $siswa->nik }}
                                </p>
                            </div>

                            <div class="mt-3 sm:mt-0 sm:text-right">
                                <p class="text-gray-700">
                                    <strong class="font-medium">Tgl Lahir:</strong>
                                    {{ \Carbon\Carbon::parse($siswa->tanggallahir)->format('d F Y') }}
                                </p>
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full mt-2">
                                    Jenjang: {{ $siswa->jenjang_dipilih }}
                                </span>
                            </div>
                            <div>
                                @if ($siswa->status == 'Lulus')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-bold text-sm">
                                        Lulus
                                    </span>
                                @elseif($siswa->status == 'Tidak Lulus')
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full font-bold text-sm">
                                        Tidak Lulus
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full font-bold text-sm">
                                        Sedang Diproses
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- Tampilan jika orang tua belum mendaftarkan siapa-siapa --}}
                    <div class="text-center p-10 bg-white border border-dashed rounded-lg">
                        <h3 class="text-xl text-gray-700">Anda belum mendaftarkan calon siswa.</h3>
                        <p class="text-gray-500 mt-2">Silakan mulai pendaftaran melalui halaman utama dashboard Anda.</p>
                        <a href="{{ route('ppdb-online.pendaftaran') }}"
                            class="inline-block mt-4 px-5 py-2 bg-green-700 text-white font-semibold rounded-lg hover:bg-green-800 transition">
                            Mulai Pendaftaran
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                <a href="{{ route('ppdb-online.index') }}"
                    class="inline-flex items-center text-gray-700 hover:text-orange-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
