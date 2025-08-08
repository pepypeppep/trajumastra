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
        Schema::create('jadwal_penyuluhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_penyuluhan')->index()->nullable();
            $table->unsignedBigInteger('id_kategori')->index()->nullable();
            $table->unsignedBigInteger('id_materi')->index()->nullable();
            $table->string('schedule')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('quota')->nullable();
            $table->longText('theme')->nullable();
            $table->integer('flag')->nullable();
            $table->string('user_request')->nullable();
            $table->longText('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_penyuluhans');
    }
};
