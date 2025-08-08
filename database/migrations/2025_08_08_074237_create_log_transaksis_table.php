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
        Schema::create('log_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_ikan')->index()->nullable();
            $table->string('fish_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('size')->nullable();
            $table->bigInteger('price')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('total')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_transaksis');
    }
};
