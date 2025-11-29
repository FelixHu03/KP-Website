@extends('layout.app')

@section('main-content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-orange-600 mb-4">Informasi & Karya Sekolah</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Ikuti perkembangan terbaru, prestasi siswa, dan karya tulis inspiratif dari keluarga besar Sekolah Pelita Sriwijaya.
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-12">
        <a href="{{ route('page.post', ['kategori' => 'semua']) }}" 
           class="px-5 py-2 rounded-full border transition duration-300 {{ $currentCategory == 'semua' ? 'bg-orange-600 text-white border-orange-600' : 'bg-white text-gray-600 border-gray-300 hover:border-orange-600 hover:text-orange-600' }}">
           Semua
        </a>
        <a href="{{ route('page.post', ['kategori' => 'berita']) }}" 
           class="px-5 py-2 rounded-full border transition duration-300 {{ $currentCategory == 'berita' ? 'bg-orange-600 text-white border-orange-600' : 'bg-white text-gray-600 border-gray-300 hover:border-orange-600 hover:text-orange-600' }}">
           Berita Sekolah
        </a>
        <a href="{{ route('page.post', ['kategori' => 'prestasi']) }}" 
           class="px-5 py-2 rounded-full border transition duration-300 {{ $currentCategory == 'prestasi' ? 'bg-orange-600 text-white border-orange-600' : 'bg-white text-gray-600 border-gray-300 hover:border-orange-600 hover:text-orange-600' }}">
           Prestasi
        </a>
        <a href="{{ route('page.post', ['kategori' => 'karya_tulis']) }}" 
           class="px-5 py-2 rounded-full border transition duration-300 {{ $currentCategory == 'karya_tulis' ? 'bg-orange-600 text-white border-orange-600' : 'bg-white text-gray-600 border-gray-300 hover:border-orange-600 hover:text-orange-600' }}">
           Karya Tulis
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100 flex flex-col h-full">
                
                <div class="h-48 overflow-hidden relative group">
                    <span class="absolute top-2 right-2 px-3 py-1 text-xs font-bold text-white rounded-md z-10
                        {{ $post->kategori == 'berita' ? 'bg-blue-500' : ($post->kategori == 'prestasi' ? 'bg-yellow-500' : 'bg-green-500') }}">
                        {{ ucwords(str_replace('_', ' ', $post->kategori)) }}
                    </span>

                    @if($post->gambar_thumbnail)
                        <img src="{{ asset('storage/' . $post->gambar_thumbnail) }}" 
                             alt="{{ $post->judul }}" 
                             class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <img src="{{ asset('assets/image/logo.png') }}" class="h-16 opacity-30">
                        </div>
                    @endif
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-sm text-gray-500 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($post->tanggal_publish)->translatedFormat('d F Y') }}
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-orange-600 transition">
                        <a href="{{ route('page.post.show', $post) }}">{{ $post->judul }}</a>
                    </h3>

                    <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">
                        {{ $post->konten_singkat ?? Str::limit(strip_tags($post->isi_konten), 120) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('page.post.show', $post) }}" class="inline-flex items-center text-orange-600 font-semibold hover:text-orange-800 transition">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada konten</h3>
                <p class="text-gray-500">Kategori ini belum memiliki postingan saat ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $posts->appends(['kategori' => $currentCategory])->links() }}
    </div>

</div>
@endsection