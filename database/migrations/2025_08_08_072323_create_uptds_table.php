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
        Schema::create('uptds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kalurahan_id')->index()->nullable();
            $table->string('name');
            $table->string('dusun')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('type')->nullable(); //1: tpi; 2: uptd
            $table->tinyInteger('status')->default(1); // 1: aktif, 0: nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uptds');
    }
};
