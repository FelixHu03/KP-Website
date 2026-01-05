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
        Schema::table('data_orang_tuas', function (Blueprint $table) {
            $table->index('user_ppdb_id');

            $table->index('nik_keluarga');
            $table->index('nik_ayah');
            $table->index('nik_ibu');

            $table->index('nama_ayah');
            $table->index('nama_ibu');

            $table->index('sumber_informasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_orang_tuas', function (Blueprint $table) {
            $table->dropIndex(['user_ppdb_id']);
            $table->dropIndex(['nik_keluarga']);
            $table->dropIndex(['nik_ayah']);
            $table->dropIndex(['nik_ibu']);
            $table->dropIndex(['nama_ayah']);
            $table->dropIndex(['nama_ibu']);
            $table->dropIndex(['sumber_informasi']);
        });
    }
};
