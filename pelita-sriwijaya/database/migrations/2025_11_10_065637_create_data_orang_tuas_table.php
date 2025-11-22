<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_orang_tuas', function (Blueprint $table) {
            $table->id(); // 'id_keluarga'

            // Kunci penghubung ke akun user
            $table->foreignId('user_ppdb_id')->constrained('user_ppdbs')->onDelete('cascade');
            $table->string('nik_keluarga');
            $table->string('kartukeluarga')->nullable();
            // Data Ayah
            $table->string('nama_ayah');
            $table->string('nik_ayah');
            $table->date('tanggallahir_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('hp_ayah');
            
            // Data Ibu
            $table->string('nama_ibu');
            $table->string('nik_ibu');
            $table->date('tanggallahir_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->string('hp_ibu');

            // Alamat & Info
            $table->text('alamat');
            $table->string('sumber_informasi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_orang_tuas');
    }
};