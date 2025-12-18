@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-gray-50 shadow-md rounded-lg p-6">
        <div class="max-w-4xl mx-auto">

            <form method="POST" action="{{ route('ppdb.data-orangtua.store') }}" class="mt-6" enctype="multipart/form-data">
                @csrf

                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    <p class="font-bold">Akun Anda berhasil dibuat!</p>
                    <p>Silakan lengkapi data orang tua Anda untuk melanjutkan.</p>
                </div>

                <div class="space-y-5 mt-5">
                    <h1 class="text-5xl"><strong>Data Orang Tua</strong></h1>
                    {{-- Nomor NIK Keluarga --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" x-data="{ nik_keluarga: '{{ old('nik_keluarga') }}' }">

                        <label for="nik_keluarga" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            Nomor NIK Keluarga <span class="text-red-500">*</span>
                        </label>

                        <div class="w-full relative">

                            <input type="text" id="nik_keluarga" name="nik_keluarga" required
                                placeholder="Masukkan 16 digit NIK" maxlength="16" x-model="nik_keluarga"
                                value="{{ old('nik_keluarga') }}"
                                x-on:input="nik_keluarga = nik_keluarga.replace(/[^0-9]/g, '')"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="nik_keluarga.length === 16 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            <div class="flex justify-between items-start mt-1">

                                <div class="text-red-500 text-sm">
                                    @error('nik_keluarga')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">


                                    <span x-show="nik_keluarga.length === 16" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Lengkap
                                    </span>

                                    <div :class="nik_keluarga.length === 16 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="nik_keluarga.length"></span>/16
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="kartukeluarga" class="md:w-48 font-medium text-lg leading-tight">
                            Kartu Keluarga<span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="kartukeluarga" name="kartukeluarga" required
                            class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('kartukeluarga')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2">Data Ayah</h2>
                    {{-- Nama AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nama_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Lenkap Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ayah" name="nama_ayah" required placeholder="Nama lengkap ayah"
                            value="{{ old('nama_ayah') }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nama_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- NIK AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" x-data="{ nik_ayah: '{{ old('nik_ayah') }}' }">

                        <label for="nik_ayah" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            NIK Ayah <span class="text-red-500">*</span>
                        </label>

                        <div class="w-full relative">

                            <input type="text" id="nik_ayah" name="nik_ayah" required
                                placeholder="Masukkan 16 digit NIK Ayah" maxlength="16" inputmode="numeric"
                                x-model="nik_ayah" x-on:input="nik_ayah = nik_ayah.replace(/[^0-9]/g, '')"
                                value="{{ old('nik_ayah') }}"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="nik_ayah.length === 16 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            <div class="flex justify-between items-start mt-1">

                                <div class="text-red-500 text-sm">
                                    @error('nik_ayah')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                    <span x-show="nik_ayah.length === 16" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Lengkap
                                    </span>

                                    <div :class="nik_ayah.length === 16 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="nik_ayah.length"></span>/16
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Tanggal Lahir AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Tanggal Lahir Ayah<span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggallahir_ayah" name="tanggallahir_ayah" required
                            value="{{ old('tanggallahir_ayah') }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('tanggallahir_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror

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
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500"
                                        {{ old('pendidikan_ayah') == $jenjang_ayah ? 'checked' : '' }}>
                                    <span class="text-lg">{{ $jenjang_ayah }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('pendidikan_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Pekerjaan AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="pekerjaan_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Pekerjaan Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" required
                            placeholder="Pekerjaan ayah" value="{{ old('pekerjaan_ayah') }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('pekerjaan_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Penghasilan Ayah --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Penghasilan Ayah <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col gap-y-2">
                            @foreach (['< Rp 3.000.000', 'Rp 3.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', '> Rp 10.000.000'] as $penghasilan)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="penghasilan_ayah" value="{{ $penghasilan }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500"
                                        {{ old('penghasilan_ayah') == $penghasilan ? 'checked' : '' }}>
                                    <span class="text-lg">{{ $penghasilan }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('penghasilan_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- HP Ayah --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" value="{{ old('hp_ayah') }}">

                        <label for="hp_ayah" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            Nomor HP Ayah <span class="text-red-500">*</span>
                        </label>

                        <div class="w-full relative">

                            <input type="tel" id="hp_ayah" name="hp_ayah" required
                                placeholder="Contoh: 0812xxxxxxx" maxlength="14" inputmode="numeric" x-model="nohp_ayah"
                                x-on:input="nohp_ayah = nohp_ayah.replace(/[^0-9]/g, '').slice(0, 14)"
                                value="{{ old('hp_ayah') }}"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="nohp_ayah.length >= 10 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            <div class="flex justify-between items-start mt-1">

                                <div class="text-red-500 text-sm">
                                    @error('hp_ayah')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                    <span x-show="nohp_ayah.length >= 10" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Oke
                                    </span>

                                    <div :class="nohp_ayah.length >= 10 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="nohp_ayah.length"></span>/14
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Ibu --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Data Ibu</h2>
                    {{-- Nama Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nama_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Nama Lengkap Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ibu" name="nama_ibu" required placeholder="Nama lengkap ibu"
                            value="{{ old('nama_ibu') }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nama_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- NIK Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" value="{{ old('nik_ibu') }}">

                        <label for="nik_ibu" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            NIK Ibu <span class="text-red-500">*</span>
                        </label>

                        <div class="w-full relative">

                            <input type="text" id="nik_ibu" name="nik_ibu" required
                                placeholder="Masukkan 16 digit NIK Ibu" maxlength="16" inputmode="numeric"
                                x-model="nik_ibu" x-on:input="nik_ibu = nik_ibu.replace(/[^0-9]/g, '')"
                                value="{{ old('nik_ibu') }}"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="nik_ibu.length === 16 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            <div class="flex justify-between items-start mt-1">

                                <div class="text-red-500 text-sm">
                                    @error('nik_ibu')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                    <span x-show="nik_ibu.length === 16" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Lengkap
                                    </span>

                                    <div :class="nik_ibu.length === 16 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="nik_ibu.length"></span>/16
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Tanggal Lahir Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Tanggal Lahir Ibu<span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggallahir_ibu" name="tanggallahir_ibu" required
                        value="{{ old('tanggallahir_ibu') }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('tanggallahir_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
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
                                        {{ old('pendidikan_ibu') == $jenjang_ibu ? 'checked' : '' }}
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $jenjang_ibu }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('pendidikan_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Pekerjaan IBU --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="pekerjaan_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Pekerjaan Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" required
                            placeholder="Pekerjaan ibu"
                            value="{{ old('pekerjaan_ibu') }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('pekerjaan_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Penghasilan ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Penghasilan ibu <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col gap-y-2">
                            @foreach (['< Rp 3.000.000', 'Rp 3.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', '> Rp 10.000.000'] as $penghasilan)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="penghasilan_ibu" value="{{ $penghasilan }}" required
                                        class="accent-blue-600 focus:ring-2 focus:ring-blue-500"
                                        {{ old('penghasilan_ibu') == $penghasilan ? 'checked' : '' }}>
                                    <span class="text-lg">{{ $penghasilan }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('penghasilan_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- HP ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4" value="{{ old('hp_ibu') }}">

                        <label for="hp_ibu" class="md:w-48 font-medium text-lg leading-tight pt-3">
                            Nomor HP ibu <span class="text-red-500">*</span>
                        </label>

                        <div class="w-full relative">

                            <input type="tel" id="hp_ibu" name="hp_ibu" required
                                placeholder="Contoh: 0812xxxxxxx" maxlength="14" inputmode="numeric" x-model="nohp_ibu"
                                value="{{ old('hp_ibu') }}"
                                x-on:input="nohp_ibu = nohp_ibu.replace(/[^0-9]/g, '').slice(0, 14)"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition"
                                :class="nohp_ibu.length >= 10 ? 'border-green-500 focus:ring-green-500' : 'border-gray-300'">

                            <div class="flex justify-between items-start mt-1">

                                <div class="text-red-500 text-sm">
                                    @error('hp_ibu')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="flex items-center text-sm font-medium transition-all duration-300 gap-2">

                                    <span x-show="nohp_ibu.length >= 10" x-transition
                                        class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Oke
                                    </span>

                                    <div :class="nohp_ibu.length >= 10 ? 'text-green-600' : 'text-gray-500'">
                                        <span x-text="nohp_ibu.length"></span>/14
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Alamat</h2>
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="alamat" class="md:w-48 font-medium text-lg leading-tight">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" required rows="4" placeholder="Alamat "
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat') }}</textarea>

                        @error('alamat')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sumber Informasi --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 font-medium text-lg leading-tight">
                            Sumber Informasi? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col gap-y-2">
                            @foreach (['Media Sosial (Instagram/Tiktok)', 'Tetangga/Kerabat', 'Banner/Brosur', 'Datang langsung ke lokasi'] as $sumber)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="sumber_informasi" value="{{ $sumber }}" required
                                        x-model="selectedSumber" class="accent-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <span class="text-lg">{{ $sumber }}</span>
                                </label>
                            @endforeach
                            {{-- Opsi Khusus 'Lainnya' --}}
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sumber_informasi" value="Lainnya" x-model="selectedSumber"
                                    required class="accent-orange-600 w-5 h-5 focus:ring-2 focus:ring-orange-500">
                                <span class="text-lg text-gray-700">Lainnya</span>
                            </label>

                            {{-- Txtt field hanya akan muncul ketika di pilih --}}
                            <div x-show="selectedSumber === 'Lainnya'" x-transition class="mt-1 ml-7">
                                {{-- ml-7 agar sejajar dengan teks radio --}}
                                <input type="text" name="sumber_informasi_lainnya"
                                    placeholder="Sebutkan sumber lainnya..."
                                    class="w-full md:w-64 border border-gray-300 rounded-md px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition shadow-sm">
                            </div>
                        </div>
                        @error('sumber_informasi')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 mt-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="konfirmasi_data_ortu" value="1" required
                            class="h-5 w-5 accent-blue-600">
                        <span class="ml-3 font-semibold text-lg">
                            Saya menyatakan bahwa data orang tua yang saya isi di atas sudah benar.
                        </span>
                    </label>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-4 mt-6 border-t">
                    <button type="submit"
                        class="px-6 py-3 bg-green-700 text-white rounded-lg hover:bg-green-800 transition font-semibold text-lg">
                        Simpan Data Saya
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
