<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserPpdb extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_ppdbs';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'tahun_ajaran',
        'nomor_handphone',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
