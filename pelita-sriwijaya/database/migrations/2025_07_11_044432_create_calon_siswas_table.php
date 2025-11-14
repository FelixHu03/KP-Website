<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calon_siswas', function (Blueprint $table) {
            $table->id();

            // Kunci penghubung ke Akun Orang Tua (UserPpdb)
            $table->foreignId('user_ppdb_id')->constrained('user_ppdbs')->onDelete('cascade');
            
            // Data Jenjang
            $table->string('jenjang_dipilih'); // TK, SD, SMP
            $table->string('tahun_ajaran');
            // Data Anak
            $table->string('namalengkap');
            $table->string('namapanggilan');
            $table->string('nik')->unique(); 
            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->string('jenis_kelamin');
            $table->string('vegetarian');
            $table->string('handphone');
            // Data Khusus SD & SMP
            $table->string('asalsekolah')->nullable();
            $table->string('nins')->nullable();
            
            // Data Khusus SMP
            $table->string('nilai_ijazah')->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_onlines');
    }
};