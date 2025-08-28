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
        Schema::create('poklashar_jenis_usaha', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poklashar_id');
            $table->foreign('poklashar_id')->references('id')->on('poklashars')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_usaha_id');
            $table->foreign('jenis_usaha_id')->references('id')->on('master_jenis_usahas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
