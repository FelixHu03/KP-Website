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
        Schema::table('dokumen_calon_siswas', function (Blueprint $table) {

            if (Schema::hasColumn('dokumen_calon_siswas', 'calon_siswa_id')) {
                $table->index('calon_siswa_id');
            }

            if (Schema::hasColumn('dokumen_calon_siswas', 'status_verifikasi')) {
                $table->index('status_verifikasi');
            }

            if (Schema::hasColumn('dokumen_calon_siswas', 'jenis_dokumen')) {
                $table->index('jenis_dokumen');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_calon_siswas', function (Blueprint $table) {
            $table->dropIndex(['calon_siswa_id']);
            $table->dropIndex(['status_verifikasi']);
            $table->dropIndex(['jenis_dokumen']);
        });
    }
};
