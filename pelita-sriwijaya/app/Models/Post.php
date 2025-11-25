<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'gambar_thumbnail',
        'konten_singkat',
        'isi_konten',
        'tanggal_publish',
        'is_published',
    ];
    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
        'tanggal_publish' => 'date',
    ];
}