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
        /* Khusus untuk kelompok binaan POKMASWAS. Karena HANYA POKMASWAS yang memiliki data Bidang */
        Schema::create('kelompok_binaan_bidang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelompok_binaan_id')->comment('ID Kelompok Binaan dengan jenis_kelompok = pokmaswas');
            $table->unsignedBigInteger('master_bidang_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_binaan_bidang');
    }
};
