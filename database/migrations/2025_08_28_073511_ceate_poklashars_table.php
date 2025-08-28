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
        Schema::create('poklashars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id')->index()->nullable();
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade');
            $table->string('name'); // Nama Kelompok
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('year')->nullable();
            $table->string('leader')->nullable();
            $table->string('pasar')->nullable();
            $table->integer('members')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poklashars');
    }
};
