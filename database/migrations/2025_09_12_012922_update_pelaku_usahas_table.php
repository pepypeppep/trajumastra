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
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            $table->foreignId('kelompok_usaha_id')
                ->nullable()
                ->after('kelompok_binaan_id')
                ->constrained('kelompok_usahas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            $table->dropForeign(['kelompok_usaha_id']);
            $table->dropColumn('kelompok_usaha_id');
        });
    }
};
