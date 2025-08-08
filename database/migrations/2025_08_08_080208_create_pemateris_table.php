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
        Schema::create('pemateris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jadwal_penyuluhan')->index()->nullable();
            $table->string('penyuluh')->nullable(); //id_penyuluh1,id_penyuluhn
            $table->string('name');
            $table->string('position')->nullable(); //jabatan
            $table->string('email')->nullable();
            $table->integer('pem');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemateris');
    }
};
