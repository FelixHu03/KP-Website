@extends('layout.app')

@section('main-content')
    <div class="max-w-7xl mx-auto px-4 py-12" x-data="{ submitted: false, showMap: true }">
        <!-- Judul -->
        <h2 class="text-3xl font-bold text-blue-800 mb-8">
            HUBUNGI KAMI
        </h2>

        <!-- Notifikasi jika sudah dikirim -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid Form dan Kontak -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Form -->
            <div>
                <h3 class="text-xl font-semibold mb-2">Tertarik untuk berdiskusi?</h3>
                <p class="text-gray-600 mb-6">
                    Kirimkan pertanyaan, kritik atau saranmu di bawah ini.
                </p>

                <form method="POST" x-ref="form" class="space-y-4" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="namalengkap" required placeholder="Nama Lengkap"
                            class="w-full border rounded px-3 py-2">
                        <input type="email" name="email" required placeholder="Alamat Email"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="subject" required placeholder="Subjek"
                            class="w-full border rounded px-3 py-2">
                        <input type="text" name="telepon" placeholder="No. HP" class="w-full border rounded px-3 py-2">
                    </div>
                    <textarea name="pesan" required rows="4" placeholder="Pesanmu" class="w-full border rounded px-3 py-2"></textarea>
                    <div class="flex space-x-2">
                        <button type="button" @click="$refs.form.reset()" class="px-4 py-2 border rounded">Reset</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded">Kirim Pesan</button>
                    </div>
                </form>
            </div>

            <!-- Info Kontak -->
            <div>
                <h3 class="text-xl font-semibold mb-2">Lebih dekat dengan kami</h3>
                <p class="text-gray-600 mb-6">Temui atau hubungi kami melalui informasi berikut:</p>

                <ul class="space-y-4 text-gray-700">
                    <li><strong>Alamat:</strong><br>Jl. Perindustrian 2 No.1369, Kebun Bunga, Kec. Sukarami, Kota Palembang,
                        Sumatera Selatan 30961</li>
                    <li><strong>Telepon:</strong> 082375537990</li>
                    <li><strong>Email:</strong> info@test.sch.id</li>
                </ul>

                <div class="mt-6 flex space-x-4 text-xl text-gray-600">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

        <!-- Lokasi (Google Map) -->
        <div class="mt-12">
            <div x-transition class="w-full h-96 rounded overflow-hidden shadow border">
                <iframe class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.6304403809677!2d104.71693011138188!3d-2.922153997041921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b74771852712d%3A0xea033dc2ce1057f2!2sSekolah%20Pelita%20Sriwijaya!5e0!3m2!1sen!2sid!4v1751611046372!5m2!1sen!2sid"
                    loading="lazy" style="border:0;" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
