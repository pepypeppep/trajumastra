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
            // $table->unsignedBigInteger('kelompok_binaan_id')->comment('ID Kelompok Binaan dengan jenis_kelompok = pokmaswas');
            // $table->unsignedBigInteger('master_bidang_id');

            $table->foreignId('kelompok_binaan_id')
                ->comment('ID Kelompok Binaan dengan jenis_kelompok = pokmaswas')
                ->constrained('kelompok_binaans')
                ->onDelete('cascade'); // Jika data kelompok binaan dihapus, maka data di tabel pivot ini akan terhapus juga

            $table->foreignId('master_bidang_id')
                ->constrained('master_bidangs')
                ->onDelete('restrict'); // Menolak penghapusan data Master Bidang jika masih ada relasi data master bidang di tabel ini

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
