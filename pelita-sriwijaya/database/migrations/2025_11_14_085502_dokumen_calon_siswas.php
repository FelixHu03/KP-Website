<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nama tabel Anda: 'dokumen_calon_siswas'
        Schema::create('dokumen_calon_siswas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('calon_siswa_id'); 

            $table->string('jenis_dokumen', 50);
            $table->string('nama_file_asli');
            $table->string('path_penyimpanan'); 
            $table->string('tipe_file', 50)->nullable();
            $table->integer('ukuran_file')->nullable();
            
            $table->enum('status_verifikasi', [
                'Diunggah', 
                'Disetujui', 
                'Ditolak'
            ])->default('Diunggah');
            
            $table->timestamps();

            // Relasi ke tabel 'calon_siswas'
            $table->foreign('calon_siswa_id')
                  ->references('id')
                  ->on('calon_siswas') // Mereferensi ke tabel 'calon_siswas'
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_calon_siswas');
    }
};