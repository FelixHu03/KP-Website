@extends('layout.app')

@section('main-content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Judul -->
        <h2 class="text-3xl font-bold text-blue-800 mb-8 text-center">
            TENTANG KAMI
        </h2>

        <!-- Deskripsi Sekolah -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-12">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Profil Sekolah</h3>
            <p class="text-gray-700 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non velit sed mauris convallis bibendum. 
                Sed nec augue vel nibh efficitur facilisis. Suspendisse potenti. Nulla facilisi. Pellentesque habitant morbi 
                tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur sit amet dui non nisl tincidunt 
                aliquam non at lorem.
            </p>
        </div>

        <!-- Misi dan Visi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Visi -->
            <div class="bg-gray-50 shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3 text-blue-700">Visi</h3>
                <p class="text-gray-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis sapien at elit luctus tristique. 
                    Etiam at tincidunt lectus. Quisque in dictum elit.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-gray-50 shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3 text-blue-700">Misi</h3>
                <ul class="list-disc pl-5 text-gray-700 space-y-2">
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Phasellus non arcu at justo porttitor iaculis.</li>
                    <li>Fusce malesuada nisi in nisi bibendum, eget sollicitudin sem elementum.</li>
                    <li>Proin consequat quam at sem commodo, sit amet tempus nisl lacinia.</li>
                </ul>
            </div>
        </div>

        <!-- Nilai-Nilai -->
        <div class="mt-12 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Nilai-Nilai Sekolah</h3>
            <p class="text-gray-700 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id libero nec risus tincidunt sollicitudin. 
                Cras at tincidunt magna. Integer varius, justo sed laoreet finibus, tortor sem bibendum enim, nec ultrices 
                purus nisl ac erat. Vivamus vitae sapien sed lorem pretium iaculis.
            </p>
        </div>

        <!-- Lokasi (Map Opsional) -->
        <div class="mt-12">
            <h3 class="text-xl font-semibold mb-4 text-blue-700">Lokasi Sekolah</h3>
            <div class="w-full h-96 rounded overflow-hidden shadow border">
                <iframe class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.6304403809677!2d104.71693011138188!3d-2.922153997041921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b74771852712d%3A0xea033dc2ce1057f2!2sSekolah%20Pelita%20Sriwijaya!5e0!3m2!1sen!2sid!4v1751611046372!5m2!1sen!2sid"
                    loading="lazy" style="border:0;" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
