@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-gray-50 shadow-md rounded-lg p-6">
        <div class="m-auto mb-6 max-w-4xl">
            <a href="{{ route('ppdb-online.index') }}"
                class="inline-flex items-center text-gray-700 hover:text-orange-600 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Halaman Utama
            </a>
        </div>
        <div class="max-w-4xl mx-auto">

            <form method="POST" action="{{ route('ppdb.data-orangtua.update') }}" class="mt-6">
                @csrf
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                        <p class="font-bold">Terjadi Kesalahan</p>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                        <p class="font-bold">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6">
                    <p class="font-bold">Ubah Data Orang Tua</p>
                    <p>Silakan perbarui data Anda di bawah ini jika ada perubahan.</p>
                </div>

                <div class="space-y-5 mt-5">
                    <h1 class="text-5xl"><strong>Data Orang Tua</strong></h1>
                    {{-- nomor nik keluarga  --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik_keluarga" class="md:w-48 font-medium text-lg leading-tight">Nomor NIK Keluarga <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nik_keluarga" name="nik_keluarga" required
                            value="{{ old('nik_keluarga', $dataOrangTua->nik_keluarga) }}"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nik_keluarga')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="kartukeluarga" class="md:w-48 font-medium text-lg leading-tight">
                            Kartu Keluarga <br>
                            <span class="text-sm text-gray-500 font-normal">(Biarkan kosong jika tidak diubah)</span>
                        </label>

                        <div class="w-full">
                            @if ($dataOrangTua->kartukeluarga)
                                <div class="mb-2 text-sm text-blue-600">
                                    <a href="{{ asset('storage/' . $dataOrangTua->kartukeluarga) }}" target="_blank"
                                        class="underline hover:text-blue-800">
                                        Lihat Kartu Keluarga Saat Ini
                                    </a>
                                </div>
                            @endif

                            <input type="file" id="kartukeluarga" name="kartukeluarga" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-sm text-gray-500 mt-1">
                                Format: JPG, JPEG, PNG, atau PDF. Maksimal ukuran file 2MB.
                            </p>
                            @error('kartukeluarga')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2">Data Ayah</h2>

                    {{-- Nama Lengkap AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nama_ayah" class="md:w-48 font-medium text-lg leading-tight">Nama Lenkap Ayah <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nama_ayah" name="nama_ayah" required
                            value="{{ old('nama_ayah', $dataOrangTua->nama_ayah) }}" class="w-full ...">
                    </div>

                    {{-- NIK AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik_ayah" class="md:w-48 ...">NIK Ayah <span class="text-red-500">*</span></label>
                        <input type="text" id="nik_ayah" name="nik_ayah" required
                            value="{{ old('nik_ayah', $dataOrangTua->nik_ayah) }}" class="w-full ...">
                        @error('nik_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir_ayah" class="md:w-48 ...">Tanggal Lahir Ayah<span
                                class="text-red-500">*</span></label>
                        <input type="date" id="tanggallahir_ayah" name="tanggallahir_ayah" required
                            value="{{ old('tanggallahir_ayah', $dataOrangTua->tanggallahir_ayah) }}" class="w-full ...">
                    </div>

                    {{-- Pendidikan AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 ...">Pendidikan Ayah <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-x-6 gap-y-2">
                            @foreach (['SD', 'SMP', 'SMA', 'SMK', 'D III', 'D IV', 'S1', 'S2', 'S3'] as $jenjang_ayah)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="pendidikan_ayah" value="{{ $jenjang_ayah }}" required
                                        @checked(old('pendidikan_ayah', $dataOrangTua->pendidikan_ayah) == $jenjang_ayah) class="accent-blue-600 ...">
                                    <span class="text-lg">{{ $jenjang_ayah }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pekerjaan AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="pekerjaan_ayah" class="md:w-48 ...">Pekerjaan Ayah <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" required
                            value="{{ old('pekerjaan_ayah', $dataOrangTua->pekerjaan_ayah) }}" class="w-full ...">
                    </div>

                    {{-- Penghasilan Ayah --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 ...">Penghasilan Ayah <span class="text-red-500">*</span></label>
                        <div class="flex flex-col gap-y-2">
                            @foreach (['< Rp 3.000.000', 'Rp 3.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', '> Rp 10.000.000'] as $penghasilan)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="penghasilan_ayah" value="{{ $penghasilan }}" required
                                        @checked(old('penghasilan_ayah', $dataOrangTua->penghasilan_ayah) == $penghasilan) class="accent-blue-600 ...">
                                    <span class="text-lg">{{ $penghasilan }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- HP Ayah --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="hp_ayah" class="md:w-48 ...">Nomor HP Ayah <span
                                class="text-red-500">*</span></label>
                        <input type="tel" id="hp_ayah" name="hp_ayah" required
                            value="{{ old('hp_ayah', $dataOrangTua->hp_ayah) }}" class="w-full ...">
                        @error('hp_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Data Ibu --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Data Ibu</h2>

                    {{-- Nama Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nama_ibu" class="md:w-48 ...">Nama Lengkap Ibu <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nama_ibu" name="nama_ibu" required
                            value="{{ old('nama_ibu', $dataOrangTua->nama_ibu) }}" class="w-full ...">
                    </div>

                    {{-- NIK Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik_ibu" class="md:w-48 ...">NIK Ibu <span class="text-red-500">*</span></label>
                        <input type="text" id="nik_ibu" name="nik_ibu" required
                            value="{{ old('nik_ibu', $dataOrangTua->nik_ibu) }}" class="w-full ...">
                        @error('nik_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir_ibu" class="md:w-48 ...">Tanggal Lahir Ibu<span
                                class="text-red-500">*</span></label>
                        <input type="date" id="tanggallahir_ibu" name="tanggallahir_ibu" required
                            value="{{ old('tanggallahir_ibu', $dataOrangTua->tanggallahir_ibu) }}" class="w-full ...">
                    </div>

                    {{-- Pendidikan ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 ...">Pendidikan ibu <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-x-6 gap-y-2">
                            @foreach (['SD', 'SMP', 'SMA', 'SMK', 'D III', 'D IV', 'S1', 'S2', 'S3'] as $jenjang_ibu)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="pendidikan_ibu" value="{{ $jenjang_ibu }}" required
                                        @checked(old('pendidikan_ibu', $dataOrangTua->pendidikan_ibu) == $jenjang_ibu) class="accent-blue-600 ...">
                                    <span class="text-lg">{{ $jenjang_ibu }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pekerjaan IBU --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="pekerjaan_ibu" class="md:w-48 ...">Pekerjaan Ibu <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" required
                            value="{{ old('pekerjaan_ibu', $dataOrangTua->pekerjaan_ibu) }}" class="w-full ...">
                    </div>

                    {{-- Penghasilan ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 ...">Penghasilan ibu <span class="text-red-500">*</span></label>
                        <div class="flex flex-col gap-y-2">
                            @foreach (['< Rp 3.000.000', 'Rp 3.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', '> Rp 10.000.000'] as $penghasilan)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="penghasilan_ibu" value="{{ $penghasilan }}" required
                                        @checked(old('penghasilan_ibu', $dataOrangTua->penghasilan_ibu) == $penghasilan) class="accent-blue-600 ...">
                                    <span class="text-lg">{{ $penghasilan }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- HP Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="hp_ibu" class="md:w-48 ...">Nomor HP Ibu <span
                                class="text-red-500">*</span></label>
                        <input type="tel" id="hp_ibu" name="hp_ibu" required
                            value="{{ old('hp_ibu', $dataOrangTua->hp_ibu) }}" class="w-full ...">
                        @error('hp_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Alamat</h2>
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="alamat" class="md:w-48 ...">Alamat <span class="text-red-500">*</span></label>
                        <textarea id="alamat" name="alamat" required rows="4" class="w-full ...">{{ old('alamat', $dataOrangTua->alamat) }}</textarea>
                    </div>



                    {{-- Sumber Informasi --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="md:w-48 ...">Sumber Informasi? <span class="text-red-500">*</span></label>
                        <div class="flex flex-col gap-y-2">
                            @foreach (['Media Sosial (Instagram/Tiktok)', 'Tetangga/Kerabat', 'Banner/Brosur', 'Datang langsung ke lokasi'] as $sumber)
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="sumber_informasi" value="{{ $sumber }}" required
                                        @checked(old('sumber_informasi', $dataOrangTua->sumber_informasi) == $sumber) class="accent-blue-600 ...">
                                    <span class="text-lg">{{ $sumber }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-4 mt-6 border-t">
                    <button type="submit"
                        class="px-6 py-3 bg-green-700 text-white rounded-lg hover:bg-green-800 transition font-semibold text-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
