<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik_keluarga',
        'user_ppdb_id',
        'nama_ayah',
        'nik_ayah',
        'tanggallahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'hp_ayah',
        'nama_ibu',
        'nik_ibu',
        'tanggallahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'hp_ibu',
        'alamat',
        'kartukeluarga',
        'sumber_informasi',
    ];
    public function user()
    {
        return $this->belongsTo(UserPpdb::class, 'user_ppdb_id');
    }
}
