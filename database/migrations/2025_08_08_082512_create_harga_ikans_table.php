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
        Schema::create('harga_ikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_ikan_id')->index()->nullable();
            // $table->unsignedBigInteger('uptd_id')->index()->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->integer('price')->nullable();
            $table->longText('unit')->nullable();
            $table->longText('size')->nullable();
            // $table->integer('stock')->default(0);
            $table->longText('spelled')->nullable();
            $table->integer('is_active')->default(1); //1: aktif; 2 off
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_ikans');
    }
};
