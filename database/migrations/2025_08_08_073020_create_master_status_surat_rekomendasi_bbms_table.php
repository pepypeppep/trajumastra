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
        Schema::create('master_status_surat_rekomendasi_bbms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('public_status');
            $table->string('actor');
            $table->integer('before')->nullable();
            $table->integer('after')->nullable();
            $table->longText('routes');
            $table->integer('is_done');
            $table->longText('button_label');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_status_surat_rekomendasi_bbms');
    }
};
