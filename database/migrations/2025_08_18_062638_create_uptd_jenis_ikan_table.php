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
        Schema::create('uptd_jenis_ikan', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('uptd_id');
            // $table->unsignedBigInteger('jenis_ikan_id');
            $table->foreignId('uptd_id')
                ->constrained('uptds')
                ->onDelete('cascade'); // Jika data UPTD dihapus, maka data di tabel pivot ini akan terhapus juga
            $table->foreignId('jenis_ikan_id')
                ->constrained('master_jenis_ikans')
                ->onDelete('restrict'); // Menolak penghapusan data Master Jenis Ikan jika masih ada relasi data master jenis ikan di tabel ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uptd_jenis_ikan');
    }
};
