<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenCalonSiswa extends Model
{
    use HasFactory;

    /**
     * PENTING:
     * Karena nama tabel Anda 'dokumen_calon_siswas' (plural),
     * kita perlu memberitahu Laravel secara eksplisit.
     * Jika tidak, Laravel akan mencari 'dokumen_calon_siswa' (singular).
     */
    protected $table = 'dokumen_calon_siswas';

    protected $fillable = [
        'calon_siswa_id',
        'jenis_dokumen',
        'nama_file_asli',
        'path_penyimpanan',
        'tipe_file',
        'ukuran_file',
        'status_verifikasi',
        'catatan_verifikator',
    ];

    /**
     * Relasi BelongsTo (kebalikan) ke model CalonSiswa.
     */
    public function calonSiswa(): BelongsTo
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }
}