@extends('layout.app')

@section('main-content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-10">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border-t-8 border-orange-500">
        <h2 class="text-2xl font-bold mb-6 text-orange-600 text-center">Login Akun PPDB</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('ppdb.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Email / Nomor HP -->
            <div>
                <label for="login" class="block text-sm font-semibold text-gray-700 mb-1">Email / Nomor Handphone <span class="text-red-500">*</span></label>
                <input type="text" id="login" name="login" placeholder="Masukkan email atau no. HP"
                    required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                <input type="password" id="password" name="password"
                    required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                Login
            </button>
        </form>

        <!-- Tambahan link ke halaman register -->
        <div class="text-center mt-6 text-sm text-gray-700">
            Belum punya akun?
            <a href="{{ route('ppdb.register') }}" class="text-blue-600 hover:underline">Silakan buat akun di sini</a>
        </div>
    </div>
</div>
@endsection
