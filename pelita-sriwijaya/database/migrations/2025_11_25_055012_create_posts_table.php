<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique(); // Untuk URL 
            $table->enum('kategori', ['berita', 'prestasi', 'karya_tulis']); // Kategori post
            $table->string('gambar_thumbnail')->nullable();
            $table->text('konten_singkat')->nullable(); // Untuk tampilan depan
            $table->longText('isi_konten'); // Isi lengkap berita
            $table->date('tanggal_publish')->default(now());
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
