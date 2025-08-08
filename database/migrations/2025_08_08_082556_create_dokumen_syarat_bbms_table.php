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
        Schema::create('dokumen_syarat_bbms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelaku_usaha')->index()->nullable();
            $table->unsignedBigInteger('id_syarat_bbm')->index()->nullable();
            $table->unsignedBigInteger('id_surat_rekomendasi_bbm')->index()->nullable();
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_syarat_bbms');
    }
};
