@extends('layout.app')

@section('main-content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="text-center mb-16">
        <h1 class="text-3xl md:text-4xl font-bold text-orange-600 mb-4">Panduan Pendaftaran PPDB Online</h1>
        <p class="text-gray-600 max-w-2xl mx-auto text-lg">
            Ikuti langkah-langkah mudah berikut untuk mendaftarkan putra-putri Anda di Sekolah Pelita Sriwijaya.
        </p>
    </div>

    <div class="space-y-12 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-300 before:to-transparent">
        
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-orange-100 group-[.is-active]:bg-orange-600 text-orange-600 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <span class="font-bold">1</span>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-2">Buat Akun Orang Tua</h3>
                <p class="text-gray-600 mb-4">
                    Untuk memulai, silakan buka menu dengan mengklik **tombol garis tiga (hamburger)** di pojok kanan atas, lalu pilih menu <a href="{{ route('ppdb.register') }}" class="text-orange-600 font-bold hover:underline">Daftar Sekarang</a>.
                </p>
                <p class="text-gray-600 mb-4">
                    Isi formulir pendaftaran dengan data yang valid, seperti Nama Lengkap, Email aktif, dan Password untuk membuat akun PPDB Anda.
                </p>
                
                <div class="mt-4 mb-4 border rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ asset('assets/image/panduanppdb/step_1.png') }}" alt="Formulir Pendaftaran Akun" class="w-full h-auto">
                </div>
                <p class="text-xs text-gray-500 mt-1 mb-4 italic text-center">Tampilan Formulir Pendaftaran Akun</p>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 text-sm text-yellow-700">
                    <span class="font-bold">Penting:</span> Gunakan email yang aktif dan sering Anda cek, karena informasi penting terkait pendaftaran akan dikirim melalui email tersebut.
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-orange-100 group-[.is-active]:bg-orange-600 text-orange-600 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <span class="font-bold">2</span>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-2">Lengkapi Data Orang Tua</h3>
                <p class="text-gray-600 mb-4">
                    Setelah berhasil membuat akun dan Login, Anda <strong>wajib</strong> mengisi data profil orang tua (Ayah & Ibu) secara lengkap.
                </p>
                <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                    <li>Siapkan data KTP dan Kartu Keluarga (KK) untuk mempermudah pengisian.</li>
                    <li>Pastikan nomor WhatsApp yang didaftarkan aktif agar mudah dihubungi oleh admin sekolah.</li>
                </ul>
                <div class="mt-4 mb-4 border rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ asset('assets/image/panduanppdb/step_2.png') }}" alt="Lengkapi Data Orang Tua" class="w-full h-auto">
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-orange-100 group-[.is-active]:bg-orange-600 text-orange-600 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <span class="font-bold">3</span>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-2">Masuk ke Dashboard</h3>
                <p class="text-gray-600 mb-3">
                    Pada halaman Dashboard Orang Tua, klik menu <strong>"Isi Formulir"</strong> untuk memulai proses pendaftaran siswa baru.
                </p>
                <div class="mt-4 mb-4 border rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ asset('assets/image/panduanppdb/step_3.png') }}" alt="Dashboard Orang Tua" class="w-full h-auto">
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-orange-100 group-[.is-active]:bg-orange-600 text-orange-600 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <span class="font-bold">4</span>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-2">Pilih Jenjang Pendidikan</h3>
                <p class="text-gray-600 mb-3">
                    Setelah mengklik tombol "Isi Formulir", sistem akan menampilkan <strong>3 pilihan jenjang pendidikan</strong> yang tersedia. Silakan pilih sesuai kebutuhan anak Anda:
                </p>
                
                <div class="mt-4 mb-4 border rounded-lg overflow-hidden shadow-sm">
                    {{-- Pastikan gambar step_4.png menampilkan screenshot tombol pilihan jenjang --}}
                    <img src="{{ asset('assets/image/panduanppdb/step_4.png') }}" alt="Pilihan Jenjang TK SD SMP" class="w-full h-auto">
                </div>

                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                        <strong>TK (Taman Kanak-Kanak)</strong>
                    </li>
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                        <strong>SD (Sekolah Dasar)</strong>
                    </li>
                    <li class="flex items-center">
                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                        <strong>SMP (Sekolah Menengah Pertama)</strong>
                    </li>
                </ul>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-orange-100 group-[.is-active]:bg-orange-600 text-orange-600 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <span class="font-bold">5</span>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-2">Isi Formulir Pendaftaran</h3>
                <p class="text-gray-600 mb-3">
                    Setelah memilih salah satu jenjang (misalnya SD), Anda akan diarahkan langsung ke halaman <strong>Formulir Pendaftaran</strong>.
                </p>
                
                <div class="mt-4 mb-4 border rounded-lg overflow-hidden shadow-sm">
                    {{-- Pastikan gambar step_5.png menampilkan screenshot form isian data siswa --}}
                    <img src="{{ asset('assets/image/panduanppdb/step_5.png') }}" alt="Formulir Data Siswa" class="w-full h-auto">
                </div>

                <div class="space-y-3">
                    <p class="text-sm text-gray-600">
                        Mohon lengkapi seluruh data yang diminta, meliputi:
                    </p>
                    <ul class="list-disc list-inside text-sm text-gray-600 ml-2">
                        <li>Data Diri Calon Siswa (Nama, NIK, Tanggal Lahir, dll).</li>
                        <li>Data Asal Sekolah (Khusus SD & SMP).</li>
                        <li><strong>Upload Dokumen:</strong> Scan Akta Kelahiran & Kartu Keluarga (Format JPG/PDF).</li>
                    </ul>
                    <div class="bg-blue-50 text-blue-800 text-xs p-2 rounded mt-2">
                        <strong>Tips:</strong> Pastikan ukuran file dokumen tidak lebih dari 2MB agar proses upload berhasil.
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-orange-100 group-[.is-active]:bg-orange-600 text-orange-600 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                <span class="font-bold">6</span>
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-2">Pantau Status & Pengumuman</h3>
                <p class="text-gray-600 mb-4">
                    Setelah mengisi formulir, data Anda akan diverifikasi oleh Admin. Pantau terus menu <strong>"Riwayat Pendaftaran"</strong>.
                </p>
                <div class="mt-4 mb-4 border rounded-lg overflow-hidden shadow-sm">
                    <img src="{{ asset('assets/image/panduanppdb/step_6.png') }}" alt="Status Pendaftaran" class="w-full h-auto">
                </div>
                <div class="grid grid-cols-2 gap-2 text-sm mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-center font-semibold border border-yellow-200">Sedang Diproses</div>
                    <div class="bg-green-100 text-green-800 px-3 py-1 rounded text-center font-semibold border border-green-200">Lulus</div>
                </div>
                <p class="text-gray-500 text-sm">
                    Jika status pendaftaran berubah menjadi <strong>Lulus</strong>, silakan lakukan daftar ulang ke sekolah membawa bukti pendaftaran.
                </p>
            </div>
        </div>

    </div>

    <div class="text-center mt-16">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Sudah siap mendaftar?</h3>
        <div class="flex justify-center gap-4">
            <a href="{{ route('ppdb.register') }}" class="px-8 py-3 bg-orange-600 text-white font-bold rounded-lg shadow hover:bg-orange-700 transition transform hover:-translate-y-1">
                Buat Akun Sekarang
            </a>
            <a href="{{ route('login') }}" class="px-8 py-3 bg-white text-orange-600 border border-orange-600 font-bold rounded-lg shadow hover:bg-orange-50 transition transform hover:-translate-y-1">
                Login
            </a>
        </div>
    </div>
</div>
@endsection