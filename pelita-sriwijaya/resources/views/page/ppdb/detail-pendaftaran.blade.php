@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-white shadow-xl rounded-lg p-6 sm:p-8">
        <div class="max-w-4xl mx-auto">

            <div class="mb-4">
                <a href="{{ route('ppdb.riwayat.index') }}"
                    class="inline-flex items-center text-gray-700 hover:text-orange-600 transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Riwayat Pendaftaran
                </a>
            </div>

            <div class="text-center border-b border-gray-200 pb-4 mb-6">
                <h2 class="text-3xl font-bold text-gray-900">{{ $siswa->namalengkap }}</h2>
                <p class="text-lg text-gray-600">{{ $siswa->nik }}</p>
                <span class="inline-block bg-blue-100 text-blue-800 text-lg font-semibold px-4 py-1 rounded-full mt-2">
                    Pendaftaran Jenjang {{ $siswa->jenjang_dipilih }} (Tahun Ajaran {{ $siswa->tahun_ajaran }})
                </span>
            </div>

            {{-- Helper untuk menampilkan baris data agar rapi --}}
            @php
                function displayRow($label, $value, $default = '-')
                {
                    if (empty($value)) {
                        $value = $default;
                    }
                    echo '<div class="flex flex-col sm:flex-row py-3 sm:py-2 border-b border-gray-100">';
                    echo '<dt class="sm:w-1/3 font-medium text-gray-600">' . htmlspecialchars($label) . '</dt>';
                    echo '<dd class="sm:w-2/3 text-gray-900 font-semibold">' . htmlspecialchars($value) . '</dd>';
                    echo '</div>';
                }
            @endphp

            <section>
                <h3 class="text-2xl font-semibold text-orange-600 mb-4">I. Data Calon Siswa</h3>
                <dl>
                    {{ displayRow('Nama Lengkap', $siswa->namalengkap) }}
                    {{ displayRow('Nama Panggilan', $siswa->namapanggilan) }}
                    {{ displayRow('NIK', $siswa->nik) }}
                    {{ displayRow('Tempat Lahir', $siswa->tempatlahir) }}
                    {{ displayRow('Tanggal Lahir', \Carbon\Carbon::parse($siswa->tanggallahir)->format('d F Y')) }}
                    {{ displayRow('Jenis Kelamin', $siswa->jenis_kelamin) }}
                    {{ displayRow('Vegetarian', $siswa->vegetarian) }}
                    {{ displayRow('Nomor Handphone', $siswa->handphone) }}
                    {{-- INFORMASI GELOMBANG --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="font-bold text-lg text-blue-800 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Informasi Pendaftaran
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Nama Gelombang --}}
                            <div>
                                <p class="text-sm text-gray-500">Gelombang Masuk</p>
                                <p class="font-bold text-gray-800 text-lg">
                                    {{ $siswa->gelombang->nama_gelombang ?? 'Gelombang Tidak Diketahui' }}
                                </p>
                            </div>

                            {{-- Biaya & Tanggal --}}
                            <div>
                                <p class="text-sm text-gray-500">Biaya Pendaftaran</p>
                                <p class="font-bold text-gray-800 text-lg">
                                    @if ($siswa->gelombang && $siswa->gelombang->biaya_pendaftaran > 0)
                                        Rp {{ number_format($siswa->gelombang->biaya_pendaftaran, 0, ',', '.') }}
                                    @else
                                        <span class="text-green-600">GRATIS</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </dl>
            </section>

            <section class="mt-8" x-data="{ jenjang: '{{ $siswa->jenjang_dipilih }}' }">
                <h3 class="text-2xl font-semibold text-orange-600 mb-4">II. Data Akademik Asal</h3>
                <dl>
                    {{-- Hanya tampil jika bukan TK --}}
                    <div x-show="jenjang !== 'TK'">
                        {{ displayRow('Asal Sekolah', $siswa->asalsekolah) }}
                    </div>
                    {{-- Hanya tampil jika SMP --}}
                    <div x-show="jenjang === 'SMP'">
                        {{ displayRow('NINS', $siswa->nins) }}
                        {{ displayRow('Nilai Ijazah SD', $siswa->nilai_ijazah) }}
                    </div>
                    {{-- Pesan jika TK --}}
                    <div x-show="jenjang === 'TK'">
                        <p class="text-gray-600 p-3 bg-gray-50 rounded">Tidak ada data akademik untuk jenjang TK.</p>
                    </div>
                </dl>
            </section>

            <section class="mt-8">
                <h3 class="text-2xl font-semibold text-orange-600 mb-4">III. Dokumen Terunggah</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse ($siswa->dokumen as $dokumen)
                        <div class="p-4 border rounded-lg bg-white shadow-sm">
                            <p class="font-bold text-gray-800">
                                {{-- Mengubah 'AKTA_KELAHIRAN' menjadi 'Akta Kelahiran' --}}
                                {{ ucwords(str_replace('_', ' ', strtolower($dokumen->jenis_dokumen))) }}
                            </p>
                            <p class="text-sm text-gray-500 mb-3">File: {{ $dokumen->nama_file_asli }}</p>

                            {{-- Status Verifikasi --}}
                            <span
                                class="inline-block px-3 py-1 text-sm font-medium rounded-full
                                @if ($dokumen->status_verifikasi == 'Disetujui') bg-green-100 text-green-800
                                @elseif($dokumen->status_verifikasi == 'Ditolak') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                Status: {{ $dokumen->status_verifikasi }}
                            </span>

                            {{-- Tampilkan Catatan Admin jika ditolak --}}
                            @if ($dokumen->status_verifikasi == 'Ditolak' && $dokumen->catatan_verifikator)
                                <p class="text-sm text-red-600 mt-2 p-2 bg-red-50 rounded">
                                    <strong>Catatan:</strong> {{ $dokumen->catatan_verifikator }}
                                </p>
                            @endif

                            <a href="{{ asset('storage/' . $dokumen->path_penyimpanan) }}" target="_blank"
                                class="block w-full mt-4 px-3 py-2 text-center bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                Lihat File
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-600 p-3 bg-gray-50 rounded col-span-2">Tidak ada dokumen yang diunggah untuk
                            siswa ini.</p>
                    @endforelse
                </div>
            </section>

            <section class="mt-8">
                <h3 class="text-2xl font-semibold text-orange-600 mb-4">IV. Data Orang Tua (Saat Mendaftar)</h3>
                @if ($siswa->user && $siswa->user->dataOrangTua)
                    @php $ortu = $siswa->user->dataOrangTua; @endphp
                    <dl>
                        {{ displayRow('Nomor KK', $ortu->nik_keluarga) }}
                        {{ displayRow('Alamat', $ortu->alamat) }}
                        <hr class="my-2 border-dashed">
                        {{ displayRow('Nama Ayah', $ortu->nama_ayah) }}
                        {{ displayRow('NIK Ayah', $ortu->nik_ayah) }}
                        {{ displayRow('Pekerjaan Ayah', $ortu->pekerjaan_ayah) }}
                        {{ displayRow('HP Ayah', $ortu->hp_ayah) }}
                        <hr class="my-2 border-dashed">
                        {{ displayRow('Nama Ibu', $ortu->nama_ibu) }}
                        {{ displayRow('NIK Ibu', $ortu->nik_ibu) }}
                        {{ displayRow('Pekerjaan Ibu', $ortu->pekerjaan_ibu) }}
                        {{ displayRow('HP Ibu', $ortu->hp_ibu) }}
                    </dl>
                @else
                    <p class="text-gray-600 p-3 bg-gray-50 rounded">Data orang tua tidak ditemukan.</p>
                @endif
            </section>
        </div>
    </div>
@endsection
