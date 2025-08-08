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
        Schema::create('log_stok_ikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_uptd')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_ikan')->index()->nullable();
            $table->unsignedBigInteger('id_user')->index()->nullable();
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_stok_ikans');
    }
};
