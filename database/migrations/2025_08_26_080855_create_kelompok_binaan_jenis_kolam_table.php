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
        /* Khusus untuk kelompok binaan POKDAKAN. Karena HANYA POKDAKAN yang memiliki data Kolam */
        Schema::create('kelompok_binaan_jenis_kolam', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('kelompok_binaan_id')->comment('ID Kelompok Binaan dengan jenis_kelompok = pokdakan');
            // $table->unsignedBigInteger('jenis_aset_id');

            $table->foreignId('kelompok_binaan_id')
                ->comment('ID Kelompok Binaan dengan jenis_kelompok = pokdakan')
                ->constrained('kelompok_binaans')
                ->onDelete('cascade'); // Jika data kelompok binaan dihapus, maka data di tabel pivot ini akan terhapus juga
            $table->foreignId('jenis_aset_id')
                ->constrained('master_jenis_asets')
                ->onDelete('restrict'); // Menolak penghapusan data Master Jenis Aset jika masih ada relasi data master jenis aset di tabel ini

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_binaan_jenis_kolam');
    }
};
