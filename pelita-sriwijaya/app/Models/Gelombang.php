<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $table = 'gelombangs';

    protected $fillable = [
        'nama_gelombang',
        'tanggal_mulai',
        'tanggal_selesai',
        'biaya_pendaftaran',
        'is_active',
    ];
}
