@extends('layout.app')

@section('main-content')
    <div class="text-start flex flex-col items-center space-y-6 py-8 px-4 md:px-10">
        <h2 class="text-3xl md:text-4xl text-center font-bold text-orange-600">
            Welcome to Pelita Sriwijaya
        </h2>
    </div>

    {{-- slider --}}
    <div class="w-full relative group" x-data="{
        images: [
            @foreach ($sliders as $slide)
                '{{ asset('storage/' . $slide->gambar) }}', @endforeach
        ],
        @if ($sliders->isEmpty()) images: [
            '{{ asset('assets/image/home/class.jpg') }}',
            '{{ asset('assets/image/home/library.jpg') }}'
        ], @endif
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
    }">
        <div class="w-full h-[300px] lg:h-[750px] md:h-[500px] relative overflow-hidden bg-gray-200">

            {{-- Tombol Kiri --}}
            <button @click="prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm shadow-md rounded-full p-3 hover:bg-white transition z-20">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>

            {{-- Gambar --}}
            <img :src="images[currentIndex]" x-bind:class="transitioning ? 'opacity-80 scale-105' : 'opacity-100 scale-100'"
                class="w-full h-full object-cover transition-all duration-500 ease-in-out" alt="Slider Image" />

            {{-- Tombol Kanan --}}
            <button @click="next"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm shadow-md rounded-full p-3 hover:bg-white transition z-20">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="text-start flex flex-col items-center space-y-10 py-8 px-4 md:px-10">

        {{-- <div x-data="{
            images: [
                '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}',
                '{{ asset('assets/image/logo tingkat sekolah/logo-tk-test.png') }}',
                '{{ asset('assets/image/logo tingkat sekolah/logo-SD-test.jpg') }}'
            ],
            handleClick(image) {
                alert('Gambar diklik: ' + image);
            }
        }" class="grid grid-flow-col grid-cols-3 gap-5 justify-center items-center mt-6">
            <template x-for="(image, index) in images" :key="index">
                <a :href="'#' + image" class="cursor-pointer transition-transform hover:scale-105">
                    <img :src="image" alt="Logo Image"
                        class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 object-cover rounded-lg shadow-md" />
                </a>
            </template>
        </div> --}}

        <div class="text-lg m-3 text-start w-full">
            <h1 class="text-orange-600 font-bold text-2xl">Selamat Datang di Sekolah Pelita Sriwijaya</h1>
            <p class="mt-2.5">Selamat datang di Sekolah Pelita Sriwijaya Palembang, tempat di mana kualitas pendidikan
                bertaraf Nasional bersanding dengan nilai-nilai keimanan. Kami berdedikasi menyelenggarakan pendidikan
                berbasis IPTEK dan pengembangan karakter melalui fasilitas modern dan guru berpengalaman. Dengan program
                unggulan bahasa Inggris dan Mandarin serta sarana pendukung yang lengkap, kami siap membimbing siswa menjadi
                pribadi yang terampil, berprestasi, dan siap bersaing secara global sesuai dengan potensi unik yang mereka
                miliki.</p>
        </div>

        <div class="text-lg m-3 text-start w-full">
            <h1 class="text-orange-600 font-bold text-2xl">Fasilitas</h1>

            <div x-data="{
                facilities: [
                    { src: '{{ asset('assets/image/home/Fasilitas/aula.jpeg') }}', label: 'Aula ' },
                    { src: '{{ asset('assets/image/home/Fasilitas/halaman_depan.jpeg') }}', label: 'Halaman Depan' },
                    { src: '{{ asset('assets/image/home/Fasilitas/play_ground.jpeg') }}', label: 'Area Bermain' },
                    { src: '{{ asset('assets/image/home/Fasilitas/Ruang_kelas.jpeg') }}', label: 'Ruang Kelas' },
                    { src: '{{ asset('assets/image/home/Fasilitas/lapangan_belakang.jpeg') }}', label: 'Lapangan Olahraga' },
                    { src: '{{ asset('assets/image/home/Fasilitas/lab.jpeg') }}', label: 'Laboratorium Komputer' },
                ]
            }"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 justify-center items-start mt-8">

                <template x-for="(item, index) in facilities" :key="index">
                    <div class="flex flex-col items-center text-center group">


                        <img :src="item.src" :alt="item.label"
                            class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 object-cover rounded-lg shadow-md" />

                        <span x-text="item.label"
                            class="mt-3 text-sm sm:text-base font-semibold text-gray-700 leading-tight"></span>

                    </div>
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
                            @if ($berita->isEmpty())
                                <div class="text-center py-10 text-gray-500">Belum ada berita terbaru.</div>
                            @endif
                        </div>

                        {{-- untuk prestasi --}}
                        <div x-show="activeTab === 'prestasi'" class="space-y-6">
                            @foreach ($prestasi as $item)
                                <a href="{{ route('page.post.show', $item) }}" class="flex space-x-4 group">
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
                            @if ($prestasi->isEmpty())
                                <div class="text-center py-10 text-gray-500">Belum ada prestasi terbaru.</div>
                            @endif
                        </div>

                        {{-- untuk karya tulis --}}
                        <div x-show="activeTab === 'karya'" class="space-y-6">
                            @foreach ($karya as $item)
                                <a href="{{ route('page.post.show', $item) }}" class="flex space-x-4 group">
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
                            @if ($karya->isEmpty())
                                <div class="text-center py-10 text-gray-500">Belum ada karya terbaru.</div>
                            @endif
                        </div>

                        {{-- TOMBOL LIHAT SELENGKAPNYA --}}
                        <div class="mt-8 flex justify-end border-t pt-4">
                            <a :href="activeTab === 'berita' ? '/berita-sekolah' : (activeTab === 'prestasi' ? '/prestasi' :
                                '/karya-tulis')"
                                class="inline-flex items-center text-orange-600 font-semibold hover:text-orange-800 transition group">
                                <span
                                    x-text="activeTab === 'berita' ? 'Lihat Semua Berita' : (activeTab === 'prestasi' ? 'Lihat Semua Prestasi' : 'Lihat Semua Karya Tulis')">
                                </span>
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
