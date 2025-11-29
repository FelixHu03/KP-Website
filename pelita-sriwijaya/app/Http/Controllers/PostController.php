<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('is_published', true);

        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        $posts = $query->latest('tanggal_publish')->paginate(9);

        return view('page.post', [
            'posts' => $posts,
            'currentCategory' => $request->kategori ?? 'semua', 
        ]);
    }
    
    // Nanti untuk halaman detail (baca selengkapnya)
    public function show(Post $post)
    {
        return view('page.post-show', [
            'post' => $post
        ]);
    }
}
