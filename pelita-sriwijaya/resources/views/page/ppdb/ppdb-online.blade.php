@extends('layout.ppdb-user') {{-- Menggunakan layout PPDB Anda --}}

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
                                
                                {{-- JIKA ANDA PUNYA GAMBAR PROFIL, GANTI DENGAN INI:
                                <img class="h-10 w-10 rounded-full object-cover" 
                                     src="{{ asset('path/ke/gambar/profil.jpg') }}" alt="Foto Profil">
                                --}}
                            </button>
                        </div>

                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                             role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{-- Mengambil nama dari user yang login di guard 'ppdb' --}}
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
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                    Pengaturan Akun
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

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">
                    Selamat Datang, {{ Auth::guard('ppdb')->user()->nama_lengkap }}!
                </h1>
                
                <p class="text-gray-700">
                    Ini adalah halaman dashboard PPDB Anda. Dari sini Anda dapat melanjutkan proses pendaftaran siswa baru.
                </p>

                </div>
        </div>
    </main>
@endsection