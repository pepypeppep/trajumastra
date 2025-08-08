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
        Schema::create('sarana_budaya_ikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelaku_usaha')->index()->nullable();
            $table->unsignedBigInteger('id_status_kepemilikan')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_aset')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_ikan_utama')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_ikan_tambahan')->index()->nullable();
            $table->string('land_area')->nullable();
            $table->string('land_used')->nullable();
            $table->string('main_fish_types')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_budaya_ikans');
    }
};
