@extends('layout.ppdb')

@section('main-content')
    <div class="bg-orange-50 min-h-screen flex items-center justify-center py-10">
        <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-xl border-t-8 border-orange-500">
            <h2 class="text-2xl font-bold mb-6 text-orange-600 text-center">Form Pendaftaran Akun PPDB</h2>

            <form action="{{ route('ppdb.register.submit') }}" method="POST" class="space-y-5">
                @csrf



                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap Orang Tua
                        <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Sesuai akta kelahiran" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email orang Tua <span
                            class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" placeholder="email aktif" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div>
                    <label for="nomor_handphone" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Handphone Orang tua (WA)
                        <span class="text-red-500">*</span></label>
                    <input type="tel" id="nomor_handphone" name="nomor_handphone" placeholder="0812xxxxxxx" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                    @error('nomor_handphone')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password Login <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required placeholder="password minimal 8 karakter"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                    <div class="mt-1 text-sm text-gray-500">*Digunakan untuk login nantinya</div>
                    {{-- Pesan Error Password --}}
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi
                        Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                    Buat Akun
                </button>
            </form>
        </div>
    </div>
@endsection
