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
        Schema::create('gelombangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gelombang');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('biaya_pendaftaran', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelombangs');
    }
};
