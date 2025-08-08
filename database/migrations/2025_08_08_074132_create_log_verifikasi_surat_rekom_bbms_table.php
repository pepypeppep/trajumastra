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
        Schema::create('log_verifikasi_surat_rekom_bbms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat_rekomendasi_bbms')->index();
            $table->unsignedBigInteger('id_user')->index();
            $table->string('status');
            $table->longText('description')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_verifikasi_surat_rekom_bbms');
    }
};
