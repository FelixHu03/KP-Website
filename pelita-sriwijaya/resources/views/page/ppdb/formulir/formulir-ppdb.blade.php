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
                        @foreach ($list_tahun as $item)
                            <option value="{{ $item->tahun }}" {{ old('tahun_ajaran') == $item->tahun ? 'selected' : '' }}>
                                {{ $item->tahun }}
                            </option>
                        @endforeach
                    </select>
                    @error('tahun_ajaran')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-5 mt-5">
                    <h1 class="text-5xl"><strong>I. Data Anak</strong></h1>

                    {{-- Nama Lengkap --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="namalengkap" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Lengkap Anak Sesuai<br>KK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="namalengkap" name="namalengkap" required value="{{ old('namalengkap') }}"
                            placeholder="nama lengkap sesuai akta kelahiran peserta didik"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('namalengkap')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Nama Panggilan --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="namapanggilan" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Panggilan Anak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="namapanggilan" name="namapanggilan" required
                            value="{{ old('namapanggilan') }}" placeholder="nama panggilan anak"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('namapanggilan')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- NIK ANAK --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" x-data="{ nik_anak: '{{ old('nik') }}' }">

                        {{-- Label --}}
                        <label for="nik" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            NIK Anak <span class="text-red-500">*</span>
                        </label>

                        {{-- Wrapper Input & Indikator --}}
                        <div class="w-full relative">

                            {{-- INPUT --}}
                            <input type="text" id="nik" name="nik" required
                                placeholder="NIK sesuai KTP atau akta kelahiran" maxlength="16" inputmode="numeric"
                                x-model="nik_anak" x-on:input="nik_anak = nik_anak.replace(/[^0-9]/g, '')"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="nik_anak.length === 16 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            {{-- INDIKATOR & ERROR --}}
                            <div class="flex justify-between items-start mt-1">

                                {{-- Kiri: Pesan Error --}}
                                <div class="text-red-500 text-sm">
                                    @error('nik')
                                        {{ $message }}
                                    @enderror
                                </div>

                                {{-- Kanan: Counter & Status Lengkap --}}
                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                    {{-- Pesan "Lengkap" --}}
                                    <span x-show="nik_anak.length === 16" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Lengkap
                                    </span>

                                    {{-- Angka Counter --}}
                                    <div :class="nik_anak.length === 16 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="nik_anak.length"></span>/16
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tempat Lahir & Tanggal Lahir --}}
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-col md:flex-1">
                            <label for="tempatlahir" class="font-medium text-lg leading-tight">
                                Tempat Lahir Calon Siswa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="tempatlahir" name="tempatlahir" required
                                placeholder="Tempat lahir sesuai akta kelahiran" value="{{ old('tempatlahir') }}"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('tempatlahir')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col md:flex-1">
                            <label for="tanggallahir" class="font-medium text-lg leading-tight">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggallahir" name="tanggallahir" required
                                value="{{ old('tanggallahir') }}"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('tanggallahir')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
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
                                        {{ old('jenis_kelamin') == $jk ? 'checked' : '' }}
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jk }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('jenis_kelamin')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Gelombang --}}
                    @php
                        $today = \Carbon\Carbon::now();
                        $gelombang = \App\Models\Gelombang::whereDate('tanggal_mulai', '<=', $today)
                            ->whereDate('tanggal_selesai', '>=', $today)
                            ->first();
                    @endphp

                    @if ($gelombang)
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4">
                            <p class="font-bold">Info Pendaftaran</p>
                            <p>Saat ini Anda mendaftar pada: <strong>{{ $gelombang->nama_gelombang }}</strong></p>
                            <p>Biaya Pendaftaran:
                                <strong>{{ $gelombang->biaya_pendaftaran == 0 ? 'GRATIS' : 'Rp ' . number_format($gelombang->biaya_pendaftaran) }}</strong>
                            </p>
                        </div>
                    @else
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <p class="font-bold">Maaf, Pendaftaran Ditutup</p>
                            <p>Tidak ada gelombang pendaftaran yang aktif saat ini.</p>
                        </div>
                    @endif

                    {{-- Vegetarian --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Vegetarian/Vegan (Untuk Keperluan MBG)<span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-6">
                            @foreach (['Ya', 'Tidak'] as $jk)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="vegetarian" value="{{ $jk }}" required
                                        {{ old('vegetarian') == $jk ? 'checked' : '' }}
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jk }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('vegetarian')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Akte --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="akta_kelahiran" class="md:w-48 font-medium text-lg leading-tight">
                            Akta Kelahiran<span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="akta_kelahiran" name="akta_kelahiran" required
                            class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('akta_kelahiran')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Bagian SD & SMP (Asal Sekolah  ) --}}
                    <div x-show="jenjang  !== 'TK'" x-transition class="space-y-5">
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="asalsekolah" class="md:w-48 font-medium text-lg leading-tight">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="asalsekolah" name="asalsekolah" :required="jenjang !== 'TK'"
                                value="{{ old('asalsekolah') }}" placeholder="Asal Sekolah calon siswa"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @error('asalsekolah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Bagian Khusus SMP --}}
                    <div x-show="jenjang === 'SMP'" x-transition class="space-y-5">
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="nilai_ijazah" class="md:w-48 font-medium text-lg leading-tight">
                                Nilai Ijazah SD <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="nilai_ijazah" name="nilai_ijazah"
                                value="{{ old('nilai_ijazah') }}" :required="jenjang === 'SMP'"
                                placeholder="Contoh: 85.50" step="0.01"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('nilai_ijazah')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col md:flex-row items-start gap-4">
                            <label for="foto_raport" class="md:w-48 font-medium text-lg leading-tight">
                                Foto Raport <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="foto_raport" name="foto_raport" :required="jenjang === 'SMP'"
                                class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('foto_raport')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- NISN --}}
                        <div class="flex flex-col md:flex-row items-start gap-4" x-data="{ nisn: '{{ old('nisn') }}' }">

                            <label for="nisn" class="md:w-48 font-medium text-lg leading-tight pt-3">
                                NISN Calon Siswa <span class="text-red-500">*</span>
                            </label>

                            <div class="w-full relative">
                                <input type="text" id="nisn" name="nisn" :required="jenjang === 'SMP'"
                                    placeholder="NISN sesuai dokumen resmi (10 Digit)" maxlength="10" inputmode="numeric"
                                    x-model="nisn" x-on:input="nisn = nisn.replace(/[^0-9]/g, '').slice(0, 10)"
                                    class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                    :class="nisn.length === 10 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                                <div class="flex justify-between items-start mt-1">

                                    <div class="text-red-500 text-sm">
                                        @error('nisn')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                        <span x-show="nisn.length === 10" x-transition
                                            class="text-green-600 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Lengkap
                                        </span>

                                        <div :class="nisn.length === 10 ? 'text-green-600' : 'text-gray-500'">
                                            <span x-text="nisn.length"></span>/10
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nomor Handphone --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" x-data="{ handphone: '{{ old('handphone') }}' }">

                        <label for="handphone" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            Nomor Handphone <span class="text-red-500">*</span>
                        </label>

                        <div class="w-full relative">
                            <input type="tel" id="handphone" name="handphone" required
                                value="{{ old('handphone') }}" placeholder="Contoh: 0812xxxxxxx" maxlength="14"
                                inputmode="numeric" x-model="handphone"
                                x-on:input="handphone = handphone.replace(/[^0-9]/g, '').slice(0, 14)"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="handphone.length >= 10 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            <div class="flex justify-between items-start mt-1">

                                <div class="text-red-500 text-sm">
                                    @error('handphone')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                    <span x-show="handphone.length >= 10" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Oke
                                    </span>

                                    <div :class="handphone.length >= 10 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="handphone.length"></span>/14
                                    </div>
                                </div>
                            </div>
                        </div>
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
