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
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->index('namalengkap');
            $table->index('nik');
            $table->index('nisn');

            $table->index('tahun_ajaran'); 
            
            $table->index('jenjang_dipilih');

            // 3. Composite Index (Kombinasi Sakti)
            $table->index(['tahun_ajaran', 'jenjang_dipilih']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->dropIndex(['namalengkap']);
            $table->dropIndex(['nik']);
            $table->dropIndex(['nisn']);
            $table->dropIndex(['tahun_ajaran']);
            $table->dropIndex(['jenjang_dipilih']);
            $table->dropIndex(['tahun_ajaran', 'jenjang_dipilih']);
        });
    }
};
