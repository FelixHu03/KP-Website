<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppdbOnline extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel jika tidak jamak (opsional tapi bagus).
     */
    protected $table = 'ppdb_onlines';

    /**
     * Kolom-kolom yang boleh diisi secara massal (Mass Assignable).
     * INI ADALAH BAGIAN YANG MEMPERBAIKI ERROR ANDA.
     */
    protected $fillable = [
        'user_ppdb_id', // Kunci penghubung ke orang tua
        'jenjang_dipilih',
        'namalengkap',
        'namapanggilan',
        'nomor_kartu_keluarga',
        'nik',
        'tempatlahir',
        'tanggallahir',
        'jenis_kelamin',
        'vegetarian',
        'handphone',
        'asalsekolah',
        'nins',
        'nilai_ijazah',
        'foto_raport',
    ];

    /**
     * Relasi KEMBALI ke Akun User (Orang Tua)
     */
    public function user()
    {
        return $this->belongsTo(UserPpdb::class, 'user_ppdb_id');
    }
}