<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() // Atau function welcome() Anda
    {
        // Ambil data berdasarkan kategori
        $berita = Post::where('kategori', 'berita')->where('is_published', true)->latest()->take(3)->get();
        $prestasi = Post::where('kategori', 'prestasi')->where('is_published', true)->latest()->take(3)->get();
        $karya = Post::where('kategori', 'karya_tulis')->where('is_published', true)->latest()->take(3)->get();

        $sliders = Slider::where('is_active', true)->get();
        return view('welcome', [ 
            'berita' => $berita,
            'prestasi' => $prestasi,
            'karya' => $karya,
            'sliders' => $sliders,
        ]);
    }
}
