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
        Schema::create('sarana_penangkapan_ikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelaku_usaha')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_usaha_sarana_ikan')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_pendaratan')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_perairan')->index()->nullable();
            $table->unsignedBigInteger('id_aset_digunakan')->index()->nullable();
            $table->unsignedBigInteger('id_status_kepemilikan')->index()->nullable();
            $table->longText('ship_name')->nullable();
            $table->longText('size')->nullable();
            $table->longText('engine_power')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_penangkapan_ikans');
    }
};
