@extends('layout.app')

@section('main-content')
    <div class="text-center flex flex-col items-center space-y-4 py-8">
        <!-- Judul -->
        <h2 class="text-3xl font-bold text-blue-800">
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
                <svg class="w-6 h-6 text-blue-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>

            <!-- Container Gambar dengan 75% lebar -->
            <div class="w-3/4 flex justify-center">
                <img :src="images[currentIndex]"
                    x-bind:class="transitioning ? 'opacity-0 scale-95' : 'opacity-100 scale-100'"
                    class="w-full h-[200px] sm:h-[250px] md:h-[300px] lg:h-[350px] xl:h-[400px] object-cover rounded-lg shadow-lg transition-all duration-300 ease-out"
                    alt="Slider Image" />
            </div>

            <!-- Tombol Kanan -->
            <button @click="next"
                class="absolute right-[5%] bg-white shadow-md rounded-full p-2 hover:bg-blue-100 transition z-10">
                <svg class="w-6 h-6 text-blue-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"></path>
                </svg>
            </button>
        </div>

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
        <p class="text-lg text-gray-600">
            Your one-stop solution for all your needs.
        </p>
    </div>
@endsection
