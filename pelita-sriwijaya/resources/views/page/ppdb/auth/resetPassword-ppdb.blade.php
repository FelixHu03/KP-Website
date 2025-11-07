@extends('layout.ppdb')

@section('main-content')
<div class="bg-orange-50 min-h-screen flex items-center justify-center py-10">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border-t-8 border-orange-500">
        <h2 class="text-2xl font-bold mb-6 text-orange-600 text-center">Reset Password</h2>

        <form method="POST" action="{{ route('ppdb.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" />
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection