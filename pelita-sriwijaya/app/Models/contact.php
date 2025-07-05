<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Str;

class contact extends Model
{
    use HasFactory;

    protected $keyType = 'string';     // UUID = string
    public $incrementing = false;      // UUID bukan auto increment
    protected $table = 'contacts';
    protected $fillable = [
        'namalengkap',
        'email',
        'telepon',
        'subject',
        'pesan',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
