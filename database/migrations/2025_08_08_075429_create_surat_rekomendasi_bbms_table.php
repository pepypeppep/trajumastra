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
        Schema::create('surat_rekomendasi_bbms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelaku_usaha')->index()->nullable();
            $table->unsignedBigInteger('id_spbu')->index()->nullable();
            $table->unsignedBigInteger('id_kapal')->index()->nullable(); //data_sarana_penangkapan_ikan.id_sarana_penangkapan_ikan
            $table->string('no');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('verification')->default(0);
            $table->longText('activity_type')->nullable();
            $table->date('finalized_at')->nullable();
            $table->date('accepted_at')->nullable();
            $table->longText('pdf_path')->nullable();
            $table->longText('ref_previous_request')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_rekomendasi_bbms');
    }
};
