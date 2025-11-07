<?php

namespace App\Models;

use App\Notifications\PpdbResetPasswordNotification;
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
        'nomor_handphone',
        'password',
        'tahun_ajaran',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // notifikasi reset password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PpdbResetPasswordNotification($token));
    }
}
