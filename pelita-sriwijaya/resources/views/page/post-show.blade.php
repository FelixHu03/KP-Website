@extends('layout.app')

@section('main-content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="mb-6">
        <a href="{{ route('page.post') }}" class="inline-flex items-center text-gray-600 hover:text-orange-600 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Informasi
        </a>
    </div>

    <div class="text-center mb-8">
        {{-- Kategori & Tanggal --}}
        <div class="flex justify-center items-center gap-4 text-sm mb-3">
            <span class="px-3 py-1 font-bold text-white rounded-md 
                {{ $post->kategori == 'berita' ? 'bg-blue-500' : ($post->kategori == 'prestasi' ? 'bg-yellow-500' : 'bg-green-500') }}">
                {{ ucwords(str_replace('_', ' ', $post->kategori)) }}
            </span>
            <span class="text-gray-500">
                {{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y') }}
            </span>
        </div>

        {{-- Judul Besar --}}
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
            {{ $post->judul }}
        </h1>
    </div>

    @if($post->gambar_thumbnail)
        <div class="w-full h-[300px] md:h-[500px] mb-10 overflow-hidden rounded-xl shadow-lg">
            <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}" 
                 alt="{{ $post->judul }}" 
                 class="w-full h-full object-cover">
        </div>
    @endif

    <article class="prose max-w-none text-gray-800 leading-relaxed text-lg space-y-6">
        {!! $post->isi_konten !!}
    </article>

    <div class="mt-12 pt-6 border-t border-gray-200 flex justify-between items-center">
        <div class="text-gray-500 text-sm">
            Diposting oleh Admin
        </div>
        
        {{-- Tombol Share Sederhana --}}
        <div class="flex gap-2">
            <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank" class="px-4 py-2 bg-green-500 text-white rounded-md text-sm hover:bg-green-600">
                Share WA
            </a>
        </div>
    </div>

</div>
@endsection