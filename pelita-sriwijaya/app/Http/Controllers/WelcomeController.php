<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() // Atau function welcome() Anda
    {
        // Ambil data berdasarkan kategori
        $berita = Post::where('kategori', 'berita')->where('is_published', true)->latest()->take(3)->get();
        $prestasi = Post::where('kategori', 'prestasi')->where('is_published', true)->latest()->take(3)->get();
        $karya = Post::where('kategori', 'karya_tulis')->where('is_published', true)->latest()->take(3)->get();

        return view('welcome', [ // Sesuaikan nama view Anda
            'berita' => $berita,
            'prestasi' => $prestasi,
            'karya' => $karya
        ]);
    }
}
