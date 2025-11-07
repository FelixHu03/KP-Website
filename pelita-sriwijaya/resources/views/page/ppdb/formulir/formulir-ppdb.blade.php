@extends('layout.ppdb-user')

@section('main-content')
    <div class="bg-gray-50 shadow-md rounded-lg p-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-4">
                <a href="{{ route('ppdb-online.pendaftaran') }}"
                    class="inline-flex items-center text-gray-700 hover:text-orange-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Pilih Jenjang
                </a>
            </div>
            <h2 class="text-xl font-semibold mb-4 text-center">PPDB Online</h2>

            <p class="text-gray-700 text-center">Selamat datang di formulir PPDB Online untuk jenjang:
                <strong class="text-orange-600">{{ $jenjang_dipilih }}</strong>
            </p>

            {{-- form --}}
            <form x-data="{ jenjang: '{{ $jenjang_dipilih }}' }" x-ref="form" method="POST" action="{{ route('ppdb-online.store') }}"
                class="space-y-5 mt-6" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="jenjang_dipilih" :value="jenjang">

                {{-- Pemberitahuan --}}
                <div class="bg-yellow-700 text-white rounded pl-4 py-3">
                    <h3 class="text-base font-semibold">Field dengan label bertanda <strong>* wajib diisi</strong></h3>
                </div>

                {{-- Nama Lengkap --}}
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <label for="namalengkap" class="md:w-48 font-medium text-lg leading-tight">
                        Nama Lengkap Calon<br>Siswa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="namalengkap" name="namalengkap" required
                        placeholder="nama lengkap sesuai akta kelahiran peserta didik"
                        class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- NIK --}}
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <label for="nik" class="md:w-48 font-medium text-lg leading-tight">
                        NIK Calon Siswa <span class="text-red-500">*</span>
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

                <div x-show="jenjang !== 'TK'" x-transition class="space-y-5">
                    {{-- Asal Sekolah & NINS --}}
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-col md:flex-1">
                            <label for="asalsekolah" class="font-medium text-lg leading-tight">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="asalsekolah" name="asalsekolah" :required="jenjang !== 'TK'"
                                {{-- 'required' menjadi dinamis --}} placeholder="Asal Sekolah calon siswa"
                                class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex flex-col md:flex-1">
                            <label for="nins" class="font-medium text-lg leading-tight">
                                NINS Calon Siswa <span class="text-red-500">*</span>
                                </Slabel>
                                <input type="number" id="nins" name="nins" :required="jenjang !== 'TK'"
                                    {{-- 'required' menjadi dinamis --}} placeholder="NINS sesuai dokumen resmi"
                                    class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                {{-- Jenis Kelamin (Selalu tampil) --}}
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

                {{-- Nomor HP (Selalu tampil) --}}
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <label for="handphone" class="md:w-48 font-medium text-lg leading-tight">
                        Nomor Handphone <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="handphone" name="handphone" required placeholder="Nomor Handphone"
                        class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div x-show="jenjang === 'SMP'" x-transition class="space-y-5">
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
                        <p class="font-bold">Bagian Khusus Pendaftar SMP</p>
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label for="nilai_ijazah" class="md:w-48 font-medium text-lg leading-tight">
                            Nilai Ijazah SD <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="nilai_ijazah" name="nilai_ijazah" :required="jenjang === 'SMP'"
                            {{-- 'required' menjadi dinamis --}} placeholder="Contoh: 85.50" step="0.01"
                            class="w-full border border-gray-300 rounded px-5 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-2">
                    <button type="button" @click="$refs.form.reset(); jenjang = ''"
                        class="px-4 py-2 border border-gray-400 rounded hover:bg-gray-100 transition">Reset</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800 transition">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
