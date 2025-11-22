@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-gray-50 shadow-md rounded-lg p-6">
        <div class="max-w-4xl mx-auto">

            <form method="POST" action="{{ route('ppdb.data-orangtua.store') }}" class="mt-6" enctype="multipart/form-data">
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
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    <p class="font-bold">Akun Anda berhasil dibuat!</p>
                    <p>Silakan lengkapi data orang tua Anda untuk melanjutkan.</p>
                </div>

                <div class="space-y-5 mt-5">
                    <h1 class="text-5xl"><strong>Data Orang Tua</strong></h1>
                    {{-- nomor nik keluarga  --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nik_keluarga" class="md:w-48 font-medium text-lg leading-tight">Nomor NIK Keluarga<span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nik_keluarga" name="nik_keluarga" required
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nik_keluarga')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="kartukeluarga" class="md:w-48 font-medium text-lg leading-tight">
                            Kartu Keluarga<span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="kartukeluarga" name="kartukeluarga" required
                            class="w-full text-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

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
                        @error('hp_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Tanggal Lahir AYAH --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="tanggallahir_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Tanggal Lahir Ayah<span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggallahir_ayah" name="tanggallahir_ayah" required
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
                            Penghasilan Ayah <span class="text-red-500">*</span>
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
                    {{-- HP Ayah --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="hp_ayah" class="md:w-48 font-medium text-lg leading-tight">
                            Nomor HP Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="hp_ayah" name="hp_ayah" required placeholder="Nomor Handphone Ayah"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('hp_ayah')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Data Ibu --}}
                    <h2 class="text-2xl font-semibold text-orange-600 border-b pb-2 mt-6">Data Ibu</h2>
                    {{-- Nama Ibu --}}
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
                        @error('nik_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
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
                            Penghasilan ibu <span class="text-red-500">*</span>
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
                    {{-- HP Ibu --}}
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="hp_ibu" class="md:w-48 font-medium text-lg leading-tight">
                            Nomor HP Ibu <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="hp_ibu" name="hp_ibu" required placeholder="Nomor Handphone Ibu"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('hp_ibu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
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
                            Sumber Informasi? <span class="text-red-500">*</span>
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
