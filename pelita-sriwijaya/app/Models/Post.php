<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    protected static function booted(): void
    {
        static::deleted(function ($post) {
            if ($post->gambar_thumbnail && Storage::disk('public')->exists($post->gambar_thumbnail)) {
                Storage::disk('public')->delete($post->gambar_thumbnail);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('gambar_thumbnail')) {
                $oldImage = $post->getOriginal('gambar_thumbnail');

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}