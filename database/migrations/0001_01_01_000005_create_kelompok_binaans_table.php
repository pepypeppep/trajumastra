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
        Schema::create('kelompok_binaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kalurahan_id')->index()->nullable();
            $table->foreign('kalurahan_id')->references('id')->on('kalurahans')->onDelete('set null');
            // Saya comment karena di V1 id_jenis_usaha pada tabel ini tidak di pakai
            // $table->unsignedBigInteger('jenis_usaha_id')->index()->nullable();
            // $table->foreign('jenis_usaha_id')->references('id')->on('master_jenis_usahas')->onDelete('set null');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->longText('business_type_name')->nullable();
            $table->integer('year');
            $table->string('npwp');
            $table->string('certificate_number')->nullable();
            $table->string('sk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_binaans');
    }
};
