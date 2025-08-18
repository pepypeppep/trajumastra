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
        Schema::create('stok_ikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uptd_id')->index()->nullable();
            $table->unsignedBigInteger('jenis_ikan_id')->index()->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_ikans');
    }
};
