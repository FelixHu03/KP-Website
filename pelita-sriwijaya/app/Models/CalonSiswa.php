<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalonSiswa extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel jika tidak jamak (opsional tapi bagus).
     */
    protected $table = 'calon_siswas';

    protected $fillable = [
        'user_ppdb_id', // Kunci penghubung ke orang tua
        'jenjang_dipilih',
        'tahun_ajaran',
        'namalengkap',
        'namapanggilan',
        'nik',
        'tempatlahir',
        'tanggallahir',
        'jenis_kelamin',
        'vegetarian',
        'handphone',
        'asalsekolah',
        'nins', // khusus SMP
        'nilai_ijazah', // khusus SMP
    ];

    /**
     * Relasi KEMBALI ke Akun User (Orang Tua)
     */
    public function user()
    {
        return $this->belongsTo(UserPpdb::class, 'user_ppdb_id');
    }
    /**
     * Relasi ke DokumenCalonSiswa
     */
    public function dokumen(): HasMany
    {
        // Pastikan Anda punya Model DokumenCalonSiswa
        return $this->hasMany(DokumenCalonSiswa::class, 'calon_siswa_id');
    }
}