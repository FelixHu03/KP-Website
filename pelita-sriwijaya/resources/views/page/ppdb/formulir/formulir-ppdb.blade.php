@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-gray-50 shadow-md rounded-lg p-6">
        <div class="max-w-4xl mx-auto">

            <div class="mb-4">
                <a href="{{ route('ppdb-online.pendaftaran') }}"
                    class="inline-flex items-center text-gray-700 hover:text-orange-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Pilih Jenjang
                </a>
            </div>

            <h2 class="text-xl font-semibold mb-4 text-center">PPDB Online</h2>
            <p class="text-gray-700 text-center text-2xl"><strong>Selamat datang di formulir PPDB Online untuk
                    jenjang:</strong>
                <strong class="text-orange-600">{{ $jenjang_dipilih }}</strong>
            </p>

            <form x-data="{ jenjang: '{{ $jenjang_dipilih }}' }" x-ref="form" method="POST" action="{{ route('ppdb-online.store') }}"
                class="mt-6" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="jenjang_dipilih" :value="jenjang">

                {{-- Pemberitahuan (Selalu terlihat di semua langkah) --}}
                <div class="bg-yellow-700 text-white rounded pl-4 py-3">
                    <h3 class="text-base font-semibold">Field dengan label bertanda <strong>* wajib diisi</strong></h3>
                </div>
                {{-- Tahun Ajaran --}}
                <div class="flex flex-col md:flex-row items-start gap-4 mt-5">
                    <label for="tahun_ajaran" class="md:w-48 font-bold text-lg leading-tight">
                        Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <select id="tahun_ajaran" name="tahun_ajaran" required
                        class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">- Pilih Tahun Ajaran -</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                    </select>
                </div>

                <div class="space-y-5 mt-5">
                    <h1 class="text-5xl"><strong>I. Data Anak</strong></h1>

                    {{-- Nama Lengkap --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="namalengkap" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Lengkap Anak Sesuai<br>KK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="namalengkap" name="namalengkap" required
                            placeholder="nama lengkap sesuai akta kelahiran peserta didik"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Nama Panggilan --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="namapanggilan" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Panggilan Anak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="namapanggilan" name="namapanggilan" required
                            placeholder="nama panggilan anak"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik" class="md:w-48 font-medium text-lg leading-tight">
                            NIK Anak <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="nik" name="nik" required
                            placeholder="NIK sesuai KTP atau akta kelahiran"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Tempat Lahir & Tanggal Lahir --}}
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-col md:flex-1">
                            <label for="tempatlahir" class="font-medium text-lg leading-tight">
                                Tempat Lahir Calon Siswa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="tempatlahir" name="tempatlahir" required
                                placeholder="Tempat lahir sesuai akta kelahiran"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col md:flex-1">
                            <label for="tanggallahir" class="font-medium text-lg leading-tight">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggallahir" name="tanggallahir" required
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-6">
                            @foreach (['Laki-laki', 'Perempuan'] as $jk)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="jenis_kelamin" value="{{ $jk }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jk }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Vegetarian --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Vegetarian/Vegan (Untuk Keperluan MBG)<span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-6">
                            @foreach (['Ya', 'Tidak'] as $jk)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="vegetarian" value="{{ $jk }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jk }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Akte --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="akta_kelahiran" class="md:w-48 font-medium text-lg leading-tight">
                            Akta Kelahiran<span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="akta_kelahiran" name="akta_kelahiran" required
                            class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    {{-- Bagian SD & SMP (Asal Sekolah  ) --}}
                    <div x-show="jenjang  !== 'TK'" x-transition class="space-y-5">
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="asalsekolah" class="md:w-48 font-medium text-lg leading-tight">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="asalsekolah" name="asalsekolah" :required="jenjang !== 'TK'"
                                placeholder="Asal Sekolah calon siswa"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    {{-- Bagian Khusus SMP --}}
                    <div x-show="jenjang === 'SMP'" x-transition class="space-y-5">
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="nilai_ijazah" class="md:w-48 font-medium text-lg leading-tight">
                                Nilai Ijazah SD <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="nilai_ijazah" name="nilai_ijazah"
                                :required="jenjang === 'SMP'" placeholder="Contoh: 85.50" step="0.01"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="foto_raport" class="md:w-48 font-medium text-lg leading-tight">
                                Foto Raport <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="foto_raport" name="foto_raport" :required="jenjang === 'SMP'"
                                class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="nins" class="md:w-48 font-medium text-lg leading-tight">
                                NINS Calon Siswa <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="nins" name="nins" :required="jenjang === 'SMP'"
                                placeholder="NINS sesuai dokumen resmi"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    {{-- Nomor HP --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="handphone" class="md:w-48 font-medium text-lg leading-tight">
                            Nomor Handphone <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="handphone" name="handphone" required placeholder="Nomor Handphone"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>

                <h2 class="text-3xl font-semibold text-orange-600 border-b pb-2 pt-6">II. Konfirmasi Data Orang Tua</h2>
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-6 rounded-lg">
                    <p class="text-lg mb-4">
                        Kami akan menggunakan Data Orang Tua (Ayah, Ibu, Alamat, dll) yang telah Anda isi saat
                        pembuatan akun.
                    </p>
                    <p class="font-semibold mb-4">
                        Jika ada kesalahan data, silakan kembali ke Dashboard dan pilih menu "Ubah Data Orang Tua"
                        sebelum melanjutkan.
                    </p>
                    <label class="flex items-center p-4 bg-white border border-blue-200 rounded-lg">
                        <input type="checkbox" name="konfirmasi_data_ortu" value="1" required
                            class="h-6 w-6 accent-blue-600">
                        <span class="ml-3 font-bold text-lg text-blue-900">
                            Saya mengonfirmasi bahwa Data Orang Tua saya sudah benar.
                        </span>
                    </label>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-4 mt-6 border-t">
                    <button type="button" @click="$refs.form.reset(); jenjang = '{{ $jenjang_dipilih }}'"
                        class="px-4 py-2 border border-gray-400 rounded hover:bg-gray-100 transition">
                        Reset
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
