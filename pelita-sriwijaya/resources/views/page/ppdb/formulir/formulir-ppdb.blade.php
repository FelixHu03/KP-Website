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

            {{-- 
            ---- PERUBAHAN 1: Tambahkan 'step: 1' ke x-data & hapus 'space-y-5' ---- 
            --}}
            <form x-data="{ jenjang: '{{ $jenjang_dipilih }}', step: 1 }" x-ref="form" method="POST" action="{{ route('ppdb-online.store') }}"
                class="mt-6" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="jenjang_dipilih" :value="jenjang">

                {{-- Pemberitahuan (Selalu terlihat di semua langkah) --}}
                <div class="bg-yellow-700 text-white rounded pl-4 py-3">
                    <h3 class="text-base font-semibold">Field dengan label bertanda <strong>* wajib diisi</strong></h3>
                </div>

                {{-- 
                ---- PERUBAHAN 2: Bungkus semua "Data Anak" dengan 'step === 1' ---- 
                --}}
                <div x-show="step === 1" class="space-y-5 mt-5">
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
                    {{-- Nomor Kartu Keluarga & NIK --}}
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-col md:flex-1">
                            <label for="nomor_kartu_keluarga" class="font-medium text-lg leading-tight">
                                Nomor Kartu Keluarga <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="nomor_kartu_keluarga" name="nomor_kartu_keluarga" required
                                placeholder="Nomor Kartu Keluarga"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex flex-col md:flex-1">
                            <label for="nik" class="font-medium text-lg leading-tight">
                                NIK Anak <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="nik" name="nik" required
                                placeholder="NIK sesuai KTP atau akta kelahiran"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
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

                    {{-- Bagian SD & SMP (Asal Sekolah, NINS) --}}
                    <div x-show="jenjang !== 'TK'" x-transition class="space-y-5">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex flex-col md:flex-1">
                                <label for="asalsekolah" class="font-medium text-lg leading-tight">
                                    Asal Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="asalsekolah" name="asalsekolah"
                                    :required="jenjang !== 'TK'" placeholder="Asal Sekolah calon siswa"
                                    class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="flex flex-col md:flex-1">
                                <label for="nins" class="font-medium text-lg leading-tight">
                                    NINS Calon Siswa <span class="text-red-500">*</span>
                                    </Slabel>
                                    <input type="number" id="nins" name="nins"
                                        :required="jenjang !== 'TK'" placeholder="NINS sesuai dokumen resmi"
                                        class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
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

                    {{-- Bagian Khusus SMP (Nilai, Upload) --}}
                    <div x-show="jenjang === 'SMP'" x-transition class="space-y-5">
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
                            <p class="font-bold">Bagian Khusus Pendaftar SMP</p>
                        </div>
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
                    </div>
                </div>
                {{-- Data orang Tua --}}
                <div x-show="step === 2" x-transition class="space-y-5 mt-5">
                    <h1 class="text-5xl"><strong>II. Data Orang Tua</strong></h1>

                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2">Data Ayah</h2>
                    {{-- Nama Lengkap AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nama_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Lenkap Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ayah" name="nama_ayah" required placeholder="Nama lengkap ayah"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- NIK AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            NIK Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik_ayah" name="nik_ayah" required placeholder="NIK ayah"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Tanggal Lahir AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir" class="md:w-48 font-medium text-lg leading-tight">
                            Tanggal Lahir Ayah<span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggallahir" name="tanggallahir" required
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Pendidikan AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Pendidikan Ayah <span class="text-red-500">*</span>
                        </label>

                        <div class="flex flex-wrap gap-x-6 gap-y-2">
                            @foreach (['SD', 'SMP', 'SMA', 'SMK', 'D III', 'D IV', 'S1', 'S2', 'S3'] as $jenjang_ayah)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="pendidikan_ayah" value="{{ $jenjang_ayah }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jenjang_ayah }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    {{-- Pekerjaan AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="pekerjaan_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Pekerjaan Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" required
                            placeholder="Pekerjaan ayah"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Penghasilan Ayah --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Penghasilan Ayah Dalam Satu Bulan<span class="text-red-500">*</span>
                        </label>

                        <div class="flex flex-col gap-y-2">
                            @foreach (['< Rp 3.000.000', 'Rp 3.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', '> Rp 10.000.000'] as $penghasilan)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="penghasilan_ayah" value="{{ $penghasilan }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $penghasilan }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="hp_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Nomor HP Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="hp_ayah" name="hp_ayah" required placeholder="Nomor Handphone Ayah"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Data Ibu --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Data Ibu</h2>
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nama_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Lengkap Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ibu" name="nama_ibu" required placeholder="Nama lengkap ibu"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- NIK Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            NIK Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik_ibu" name="nik_ibu" required placeholder="NIK ibu"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Tanggal Lahir Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Tanggal Lahir Ibu<span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggallahir_ibu" name="tanggallahir_ibu" required
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Pendidikan ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Pendidikan ibu <span class="text-red-500">*</span>
                        </label>

                        <div class="flex flex-wrap gap-x-6 gap-y-2">
                            @foreach (['SD', 'SMP', 'SMA', 'SMK', 'D III', 'D IV', 'S1', 'S2', 'S3'] as $jenjang_ibu)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="pendidikan_ibu" value="{{ $jenjang_ibu }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jenjang_ibu }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    {{-- Pekerjaan IBU --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="pekerjaan_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Pekerjaan Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" required
                            placeholder="Pekerjaan ibu"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Penghasilan ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Penghasilan ibu Dalam Satu Bulan<span class="text-red-500">*</span>
                        </label>

                        <div class="flex flex-col gap-y-2">
                            @foreach (['< Rp 3.000.000', 'Rp 3.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', '> Rp 10.000.000'] as $penghasilan)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="penghasilan_ibu" value="{{ $penghasilan }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $penghasilan }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Nomor HP Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="hp_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Nomor HP Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="hp_ibu" name="hp_ibu" required placeholder="Nomor Handphone Ibu"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    {{-- Alamat --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Alamat</h2>
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="alamat" class="md:w-48 font-medium text-lg leading-tight">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" required rows="4" placeholder="Alamat "
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    {{-- Sumber Informasi --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Darimana Bapak/Ibu tahu tentang Sekolah Pelita Sriwijaya? <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="flex flex-col gap-y-2">
                            @foreach (['Media Sosial (Instagram/Tiktok)', 'Tetangga/Kerabat', 'Banner/Brosur', 'Datang langsung ke lokasi'] as $sumber)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="sumber_informasi" value="{{ $sumber }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $sumber }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-4 mt-6 border-t">

                    <button type="button" @click="$refs.form.reset(); jenjang = '{{ $jenjang_dipilih }}'; step = 1"
                        class="px-4 py-2 border border-gray-400 rounded hover:bg-gray-100 transition">
                        Reset
                    </button>

                    <button type="button" x-show="step === 2" @click.prevent="step = 1"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                        Kembali ke Data Anak
                    </button>

                    <button type="button" x-show="step === 1" @click.prevent="step = 2"
                        class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800 transition">
                        Lanjut ke Data Orang Tua
                    </button>

                    <button type="submit" x-show="step === 2"
                        class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
