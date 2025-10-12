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
        Schema::create('kelompok_binaan_jenis_usaha', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('kelompok_binaan_id');
            // $table->unsignedBigInteger('jenis_usaha_id');

            $table->foreignId('kelompok_binaan_id')
                ->constrained('kelompok_binaans')
                ->onDelete('cascade'); // Jika data kelompok binaan dihapus, maka data di tabel pivot ini akan terhapus juga

            $table->foreignId('jenis_usaha_id')
                ->constrained('master_jenis_usahas')
                ->onDelete('restrict'); // Menolak penghapusan data Master Jenis Usaha jika masih ada relasi data master jenis usaha di tabel ini

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_binaan_jenis_usaha');
    }
};
