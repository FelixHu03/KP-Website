@extends('layout.app')

@section('main-content')
    <div class="text-start flex flex-col items-center space-y-12 py-8">
        <!-- Judul -->
        <h2 class="text-3xl text-center items-center font-bold text-orange-600">
            Welcome to Pelita Sriwijaya
        </h2>

        <!-- auto gambar -->
        <div x-data="{
            images: [
                '{{ asset('assets/image/home/class.jpg') }}',
                '{{ asset('assets/image/home/class-person.jpg') }}',
                '{{ asset('assets/image/home/library.jpg') }}'
            ],
            currentIndex: 0,
            transitioning: false,
            init() {
                setInterval(() => {
                    this.next()
                }, 3000)
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
            <!-- Tombol Kiri -->
            <button @click="prev"
                class="absolute left-[5%] bg-white shadow-md rounded-full p-2 hover:bg-blue-100 transition z-10">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>

            <!-- Container Gambar -->
            <div class="w-3/4 flex justify-center">
                <img :src="images[currentIndex]"
                    x-bind:class="transitioning ? 'opacity-0 scale-95' : 'opacity-100 scale-100'"
                    class="w-full h-[200px] sm:h-[250px] md:h-[300px] lg:h-[350px] xl:h-[400px] object-cover rounded-lg shadow-lg transition-all duration-300 ease-out"
                    alt="Slider Image" />
            </div>

            <!-- Tombol Kanan -->
            <button @click="next"
                class="absolute right-[5%] bg-white shadow-md rounded-full p-2 hover:bg-orange-100 transition z-10">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"></path>
                </svg>
            </button>
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
        <div class="text-lg m-3 text-start w-full ">
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

                            <a href="#" class="flex space-x-4 group">
                                <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md">
                                </div>
                                <div class="flex-grow">
                                    <p class="text-sm text-gray-500">Oktober 25, 2025</p>
                                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-orange-600">
                                        Prestasi yang Telah di Capai Oleh XYZ di Palembang 2025
                                    </h3>
                                    <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                        daksmdkamskdmaskdmakmsdkmaskdmasmkdmkasmlkdnlasm adasdsotmakmsdkamsdkmas
                                    </p>
                                </div>
                            </a>

                            <a href="#" class="flex space-x-4 group">
                                <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md"></div>
                                <div class="flex-grow">
                                    <p class="text-sm text-gray-500">Oktober 24, 2025</p>
                                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-orange-600">
                                        Berita Sekolah Mengenai Acara 17 Agustus
                                    </h3>
                                    <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </a>

                            <a href="#" class="flex space-x-4 group">
                                <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md"></div>
                                <div class="flex-grow">
                                    <p class="text-sm text-gray-500">Oktober 23, 2025</p>
                                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-orange-600">
                                        Pembukaan Pendaftaran Siswa Baru Tahun Ajaran 2026
                                    </h3>
                                    <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                        ex ea commodo consequat.
                                    </p>
                                </div>
                            </a>

                        </div>
                        {{-- untuk prestasi --}}
                        <div x-show="activeTab === 'prestasi'" class="space-y-6">
                            <a href="#" class="flex space-x-4 group">
                                <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md"></div>
                                <div class="flex-grow">
                                    <p class="text-sm text-gray-500">September 15, 2025</p>
                                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-orange-600">
                                        Juara 1 Lomba Cerdas Cermat Tingkat Nasional
                                    </h3>
                                    <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                        Ini adalah konten untuk **Prestasi**. Siswa kami berhasil memenangkan lomba...
                                    </p>
                                </div>
                            </a>
                        </div>
                        {{-- untuk karya tulis --}}
                        <div x-show="activeTab === 'karya'" class="space-y-6">
                            <a href="#" class="flex space-x-4 group">
                                <div class="flex-shrink-0 w-28 h-20 bg-gray-200 rounded-md"></div>
                                <div class="flex-grow">
                                    <p class="text-sm text-gray-500">Agustus 10, 2025</p>
                                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-orange-600">
                                        Analisis Dampak Teknologi Terhadap Pola Belajar
                                    </h3>
                                    <p class="text-base text-gray-700 leading-snug mt-1 line-clamp-2">
                                        Ini adalah konten untuk **Karya Tulis**. Sebuah esai yang ditulis oleh siswa kami...
                                    </p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
