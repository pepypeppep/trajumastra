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
        Schema::create('pokdakan_jenis_ikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pokdakan_id');
            $table->unsignedBigInteger('jenis_ikan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokdakan_jenis_ikan');
    }
};
