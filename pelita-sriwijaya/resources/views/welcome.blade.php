@extends('layout.app')

@section('main-content')
    <div class="text-start flex flex-col items-center space-y-10 py-8 ml-10 mr-10 ">
        <!-- Judul -->
        <h2 class="text-3xl text-center items-center font-bold text-orange-600">
            Welcome to Pelita Sriwijaya
        </h2>

        <!-- auto gambar -->
        <div x-data="{
            images: [
                    @foreach ($sliders as $slide)
            '{{ asset('storage/' . $slide->gambar) }}', @endforeach
                ],
            @if ($sliders->isEmpty()) images: [
            '{{ asset('assets/image/home/class.jpg') }}',
            '{{ asset('assets/image/home/library.jpg') }}'
        ], @endif
            {{-- BAGIAN BAWAH TETAP SAMA --}}
            currentIndex: 0,
                transitioning: false,
                init() {
                    if (this.images.length > 1) { 
                        setInterval(() => {
                            this.next()
                        }, 3500)
                    }
                },
                next() {
                    this.transitioning = true
                    setTimeout(() => {
                        this.currentIndex = (this.currentIndex + 1) % this.images.length
                        this.transitioning = false
                    }, 300)
                },
                prev() {
                    this.transitioning = true
                    setTimeout(() => {
                        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length
                        this.transitioning = false
                    }, 300)
                }
        }" class="w-full flex items-center justify-center relative">


            <!-- Container Gambar -->
            <div class="w-full flex justify-center ">
                <!-- Tombol Kiri -->
                <button @click="prev"
                    class="absolute left-[2%] top-1/2 -translate-y-1/2 bg-white shadow-md rounded-full p-2 hover:bg-blue-100 transition z-10 opacity-60 ">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"></path>
                    </svg>
                </button>
                <img :src="images[currentIndex]"
                    x-bind:class="transitioning ? 'opacity-0 scale-95' : 'opacity-100 scale-100'"
                    class="w-full h-[200px] sm:h-[250px] md:h-[300px] lg:h-[350px] xl:h-[600px] object-cover rounded-lg shadow-lg transition-all duration-300 ease-out"
                    alt="Slider Image" />

                <!-- Tombol Kanan -->
                <button @click="next"
                    class="absolute right-[2%] top-1/2 -translate-y-1/2 bg-white shadow-md rounded-full p-2 hover:bg-orange-100 transition z-10 opacity-60">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"></path>
                    </svg>
                </button>
            </div>

        </div>
        <!-- Logo Tingkat Sekolah -->
        <div x-data="{
            images: [
                '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}',
                '{{ asset('assets/image/logo tingkat sekolah/logo-tk-test.png') }}',
                '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}'
            ],
            handleClick(image) {
                alert('Gambar diklik: ' + image);
            }
        }" class="grid grid-flow-col grid-cols-3 gap-5 justify-center items-center">
            <template x-for="(image, index) in images" :key="index">
                <a :href="'#' + image" class="cursor-pointer transition-transform hover:scale-105">
                    <img :src="image" alt="Logo Image"
                        class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 object-cover rounded-lg shadow-md" />
                </a>
            </template>
        </div>




        <!-- Deskripsi -->
        <div class="text-lg m-3 text-start w-full mt-">
            <h1 class="text-orange-600 font-bold text-2xl">Selamat Datang di Sekolah Pelita Sriwijaya</h1>
            <p class="mt-2.5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum</p>
        </div>
        <!-- Fasilitas-->
        <div class="text-lg m-3 text-start w-full ">
            <h1 class="text-orange-600 font-bold text-2xl">Fasilitas</h1>
            <div x-data="{
                images: [
                    '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}',
                    '{{ asset('assets/image/logo tingkat sekolah/logo-tk-test.png') }}',
                    '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}',
                    '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}',
                    '{{ asset('assets/image/logo tingkat sekolah/logo-tk-test.png') }}',
                    '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}'
                ],
                handleClick(image) {
                    alert('Gambar diklik: ' + image);
                }
            }" class="grid grid-flow-col grid-cols-6 gap-2 justify-center items-center mt-8">
                <template x-for="(image, index) in images" :key="index">
                    <a :href="'#' + image" class="cursor-pointer transition-transform hover:scale-105">
                        <img :src="image" alt="Logo Image"
                            class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 object-cover rounded-lg shadow-md" />
                    </a>
                </template>
            </div>
        </div>

        {{-- Info Terbaru --}}
        <div class="text-lg m-3 text-start w-full">
            <h1 class="text-orange-600 font-bold text-2xl">Info Terbaru</h1>

            <div class="flex flex-col lg:flex-row lg:space-x-8 mt-8">

                <div class="w-full lg:w-5/12">
                    <img src="{{ asset('assets/image/home/library.jpg') }}" alt="Perpustakaan"
                        class="w-full h-full max-h-96 object-cover rounded-lg shadow-md">
                </div>

                <div x-data="{ activeTab: 'berita' }" class="w-full lg:w-7/12 mt-6 lg:mt-0">
                    {{-- navbar Info --}}
                    <div class="flex space-x-6 md:space-x-8 border-b border-gray-300">
                        <button @click="activeTab = 'berita'" class="pb-2 font-semibold transition-colors"
                            :class="{
                                'text-orange-600 border-b-2 border-orange-600': activeTab === 'berita',
                                'text-gray-600 hover:text-orange-600': activeTab !== 'berita'
                            }">
                            Berita Sekolah
                        </button>
                        <button @click="activeTab = 'prestasi'" class="pb-2 font-semibold transition-colors"
                            :class="{
                                'text-orange-600 border-b-2 border-orange-600': activeTab === 'prestasi',
                                'text-gray-600 hover:text-orange-600': activeTab !== 'prestasi'
                            }">
                            Prestasi
                        </button>
                        <button @click="activeTab = 'karya'" class="pb-2 font-semibold transition-colors"
                            :class="{
                                'text-orange-600 border-b-2 border-orange-600': activeTab === 'karya',
                                'text-gray-600 hover:text-orange-600': activeTab !== 'karya'
                            }">
                            Karya Tulis
                        </button>
                    </div>

                    <div class="mt-6">
                        {{-- untuk berita --}}
                        <div x-show="activeTab === 'berita'" class="space-y-6">

                            @foreach ($berita as $item)
                                <a href="{{ route('page.post.show', $item) }}" class="flex space-x-4 group">
                                    {{-- KOTAK GAMBAR --}}
                                    <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md overflow-hidden">
                                        {{-- Cek apakah ada gambar, jika tidak pakai gambar default --}}
                                        @if ($item->gambar_thumbnail)
                                            <img src="{{ asset('storage/' . $item->gambar_thumbnail) }}"
                                                class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                                                alt="{{ $item->judul }}">
                                        @else
                                            <img src="{{ asset('assets/image/logo.png') }}"
                                                class="w-full h-full object-contain p-2 opacity-50" alt="No Image">
                                        @endif
                                    </div>

                                    {{-- KONTEN TEKS --}}
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                                        </p>
                                        <h3
                                            class="font-bold text-lg text-gray-900 group-hover:text-orange-600 line-clamp-2">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                            {{ $item->konten_singkat ?? Str::limit(strip_tags($item->isi_konten), 100) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach

                            {{-- Pesan jika data kosong --}}
                            @if ($berita->isEmpty())
                                <div class="text-center py-10 text-gray-500">
                                    Belum ada berita terbaru.
                                </div>
                            @endif

                        </div>
                        {{-- untuk prestasi --}}
                        <div x-show="activeTab === 'prestasi'" class="space-y-6">

                            @foreach ($prestasi as $item)
                                <a href="{{ route('page.post.show', $item) }}" class="flex space-x-4 group">
                                    {{-- KOTAK GAMBAR --}}
                                    <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md overflow-hidden">
                                        @if ($item->gambar_thumbnail)
                                            <img src="{{ asset('storage/' . $item->gambar_thumbnail) }}"
                                                class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                                                alt="{{ $item->judul }}">
                                        @else
                                            <img src="{{ asset('assets/image/logo.png') }}"
                                                class="w-full h-full object-contain p-2 opacity-50" alt="No Image">
                                        @endif
                                    </div>

                                    {{-- KONTEN TEKS --}}
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                                        </p>
                                        <h3
                                            class="font-bold text-lg text-gray-900 group-hover:text-orange-600 line-clamp-2">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                            {{ $item->konten_singkat ?? Str::limit(strip_tags($item->isi_konten), 100) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach

                            {{-- Pesan jika data kosong --}}
                            @if ($prestasi->isEmpty())
                                <div class="text-center py-10 text-gray-500">
                                    Belum ada prestasi terbaru.
                                </div>
                            @endif

                        </div>
                        {{-- untuk karya tulis --}}
                        <div x-show="activeTab === 'karya'" class="space-y-6">

                            @foreach ($karya as $item)
                                <a href="{{ route('page.post.show', $item) }}" class="flex space-x-4 group">
                                    {{-- KOTAK GAMBAR --}}
                                    <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md overflow-hidden">
                                        @if ($item->gambar_thumbnail)
                                            <img src="{{ asset('storage/' . $item->gambar_thumbnail) }}"
                                                class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                                                alt="{{ $item->judul }}">
                                        @else
                                            <img src="{{ asset('assets/image/logo.png') }}"
                                                class="w-full h-full object-contain p-2 opacity-50" alt="No Image">
                                        @endif
                                    </div>

                                    {{-- KONTEN TEKS --}}
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                                        </p>
                                        <h3
                                            class="font-bold text-lg text-gray-900 group-hover:text-orange-600 line-clamp-2">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                            {{ $item->konten_singkat ?? Str::limit(strip_tags($item->isi_konten), 100) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach

                            {{-- Pesan jika data kosong --}}
                            @if ($karya->isEmpty())
                                <div class="text-center py-10 text-gray-500">
                                    Belum ada karya terbaru.
                                </div>
                            @endif

                        </div>
                        {{-- TOMBOL LIHAT SELENGKAPNYA --}}
                        <div class="mt-8 flex justify-end border-t pt-4">
                            <a {{-- Ubah link secara dinamis berdasarkan tab yang aktif --}}
                                :href="activeTab === 'berita' ? '/berita-sekolah' :
                                    (activeTab === 'prestasi' ? '/prestasi' : '/karya-tulis')"
                                class="inline-flex items-center text-orange-600 font-semibold hover:text-orange-800 transition group">
                                <span
                                    x-text="activeTab === 'berita' ? 'Lihat Semua Berita' : 
                         (activeTab === 'prestasi' ? 'Lihat Semua Prestasi' : 'Lihat Semua Karya Tulis')">
                                </span>

                                {{-- Ikon Panah --}}
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
