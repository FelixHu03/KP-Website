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
            $table->foreignId('gelombang_id')
                ->nullable()
                ->after('user_ppdb_id')
                ->constrained('gelombangs')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->dropForeign(['gelombang_id']);
            $table->dropColumn('gelombang_id');
        });
    }
};
