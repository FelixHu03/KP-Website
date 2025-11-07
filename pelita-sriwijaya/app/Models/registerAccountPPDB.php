<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registerAccountPPDB extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_handphone',
        'password',
        'tahun_ajaran',
    ];
}
