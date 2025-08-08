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
        Schema::create('master_retribusis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_ikan')->index();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('flag');
            $table->bigInteger('top_price');
            $table->bigInteger('bottom_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_retribusis');
    }
};
