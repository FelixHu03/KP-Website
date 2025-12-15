<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'gambar',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $guarded = [];
    protected static function booted(): void
    {
        static::deleted(function ($slider) {
            if ($slider->gambar && Storage::disk('public')->exists($slider->gambar)) {
                Storage::disk('public')->delete($slider->gambar);
            }
        });

        static::updating(function ($slider) {
            if ($slider->isDirty('gambar')) {
                $oldImage = $slider->getOriginal('gambar');

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
