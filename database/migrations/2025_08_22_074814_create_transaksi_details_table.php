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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id')->index()->nullable();
            $table->unsignedBigInteger('master_jenis_ikans_id')->index()->nullable();
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->string('size')->nullable();
            $table->integer('price')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('total')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
