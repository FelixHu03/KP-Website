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
        Schema::table('support_tables', function (Blueprint $table) {
            // 1. Table USERS (Admin)
            Schema::table('users', function (Blueprint $table) {
                // Cek dulu apakah kolom 'name' ada sebelum index
                if (Schema::hasColumn('users', 'name')) {
                    $table->index('name'); // Mempercepat pencarian nama admin
                }
            });

            // 2. Table USER_PPDBS (Akun Pendaftar)
            Schema::table('user_ppdbs', function (Blueprint $table) {
                $table->index('nama_lengkap');
                $table->index('email');
                // Jika ada kolom HP
                if (Schema::hasColumn('user_ppdbs', 'nomor_handphone')) {
                    $table->index('nomor_handphone');
                }
            });

            // 3. Table POSTS (Berita)
            Schema::table('posts', function (Blueprint $table) {
                if (Schema::hasColumn('posts', 'slug')) {
                    $table->index('slug'); // Agar akses URL berita cepat
                }
                if (Schema::hasColumn('posts', 'title')) {
                    $table->index('title'); // Untuk fitur search berita
                }
                if (Schema::hasColumn('posts', 'status')) {
                    $table->index('status'); // Mempercepat filter berdasarkan status publish
                }
            });

            Schema::table('sliders', function (Blueprint $table) {
                if (Schema::hasColumn('sliders', 'is_active')) {
                    $table->index('is_active');
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_tables', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex(['name']);
            });

            Schema::table('user_ppdbs', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['email']);
                if (Schema::hasColumn('user_ppdbs', 'handphone')) {
                    $table->dropIndex(['handphone']);
                }
            });

            Schema::table('posts', function (Blueprint $table) {
                if (Schema::hasColumn('posts', 'slug')) $table->dropIndex(['slug']);
                if (Schema::hasColumn('posts', 'title')) $table->dropIndex(['title']);
                if (Schema::hasColumn('posts', 'status')) $table->dropIndex(['status']);
            });

            Schema::table('sliders', function (Blueprint $table) {
                if (Schema::hasColumn('sliders', 'is_active')) $table->dropIndex(['is_active']);
            });
        });
    }
};
