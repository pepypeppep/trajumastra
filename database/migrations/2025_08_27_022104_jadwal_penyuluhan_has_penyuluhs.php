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
        Schema::create('jadwal_penyuluhan_has_penyuluhs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_penyuluhan_id')->index()->nullable();
            $table->foreign('jadwal_penyuluhan_id')->references('id')->on('jadwal_penyuluhans')->onDelete('cascade');
            $table->unsignedBigInteger('penyuluh_id')->index()->nullable();
            $table->foreign('penyuluh_id')->references('id')->on('penyuluhs')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_penyuluhan_has_penyuluhs');
    }
};
