@extends('layout.ppdb-user') 

@section('main-content')
    <header class="bg-white shadow-md">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('ppdb-online.index') }}" class="text-2xl font-bold text-orange-600">
                        Dashboard PPDB
                    </a>
                </div>

                <div class="ml-4 flex items-center">
                    <div x-data="{ open: false }" class="relative ml-3">
                        <div>
                            <button @click="open = !open"
                                class="flex text-sm bg-gray-200 rounded-full w-10 h-10 items-center justify-center text-gray-500 focus:outline-none hover:bg-gray-300 transition"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Buka menu</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </button>
                        </div>

                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition
                             class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                             role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ Auth::guard('ppdb')->user()->nama_lengkap }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ Auth::guard('ppdb')->user()->email }}
                                </p>
                            </div>

                            <div class="py-1" role="none">
                                <a href="{{ route('ppdb-online.pendaftaran') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                    Isi Formulir
                                </a>
                                <a href="{{ route('ppdb.data-orangtua.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                    Ubah Data Orang Tua
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                    Riwayat Pendaftaran
                                </a>
                            </div>

                            <div class="py-1 border-t border-gray-200" role="none">
                                <form method="POST" action="{{ route('logout') }}" role="menuitem" tabindex="-1">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-0">

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h1 class="text-2xl font-bold text-gray-900">
                    Selamat Datang, {{ Auth::guard('ppdb')->user()->nama_lengkap }}!
                </h1>
                <p class="text-gray-700 mt-1">
                    Silakan pilih menu di bawah untuk melanjutkan proses pendaftaran.
                </p>
                
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <a href="{{ route('ppdb-online.pendaftaran') }}"
                   class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                    
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5a3.375 3.375 0 00-3.375 3.375v2.625m9 0H9.75l-1.5-1.5m1.5 1.5H5.625c-.621 0-1.125-.504-1.125-1.125v-6c0-.621.504-1.125 1.125-1.125h12.75c.621 0 1.125.504 1.125 1.125v6c0 .621-.504-1.125-1.125-1.125H15" />
                        </svg>
                    </div>
                    
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Isi Formulir</h3>
                    <p class="mt-1 text-gray-600">Mulai mendaftarkan data anak Anda (TK, SD, atau SMP).</p>
                </a>

                <a href="{{ route('ppdb.data-orangtua.create') }}"
                   class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                    
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                        <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 00-12 0l-1.162-.982a10.59 10.59 0 0114.324 0l-1.162.982zM12 14.25a3 3 0 100-6 3 3 0 000 6z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Ubah Data Orang Tua</h3>
                    <p class="mt-1 text-gray-600">Perbarui data keluarga, alamat, dan kontak Anda.</p>
                </a>

                <a href="#" {{-- Ganti '#' dengan rute Anda nanti --}}
                   class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                    
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18c.621 0 1.125-.504 1.125-1.125V8.25c0-.621-.504-1.125-1.125-1.125h-6.75c-.621 0-1.125.504-1.125 1.125v3.75c0 .621.504 1.125 1.125 1.125h3.75m0 0h3.75m-3.75 0p-3.75 0M9 12.75h3.75" />
                        </svg>
                    </div>
                    
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Riwayat Pendaftaran</h3>
                    <p class="mt-1 text-gray-600">Lihat status dan riwayat pendaftaran anak-anak Anda.</p>
                </a>

                <form method="POST" action="{{ route('logout') }}"
                      class="block p-6 bg-red-50 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1 border border-red-200">
                    @csrf
                    
                    <button type="submit" class="w-full h-full text-left">
                        
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </div>
                        
                        <h3 class="mt-4 text-xl font-semibold text-red-700">Logout</h3>
                        <p class="mt-1 text-gray-600">Keluar dari akun Anda dengan aman.</p>
                    </button>
                </form>

            </div> </div>
    </main>
@endsection