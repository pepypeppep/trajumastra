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
        Schema::create('pelaku_usahas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kalurahan_id')->index()->nullable();
            $table->foreign('kalurahan_id')->references('id')->on('kalurahans')->onDelete('set null');
            $table->unsignedBigInteger('kelompok_binaan_id')->index()->nullable();
            $table->foreign('kelompok_binaan_id')->references('id')->on('kelompok_binaans')->onDelete('set null');
            $table->unsignedBigInteger('bentuk_usaha_id')->index()->nullable();
            $table->foreign('bentuk_usaha_id')->references('id')->on('bentuk_usahas')->onDelete('set null');
            $table->unsignedBigInteger('jenis_usaha_id')->index()->nullable();
            $table->foreign('jenis_usaha_id')->references('id')->on('jenis_usahas')->onDelete('set null');
            $table->integer('type'); //1.nelayan, 0.pembudidaya
            $table->string('nik')->unique();
            $table->string('name');
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('npwp')->nullable();
            $table->string('siup')->nullable();
            $table->string('gender')->nullable();
            $table->string('income_range')->nullable();
            $table->string('born_place')->nullable();
            $table->date('born_date')->nullable();
            $table->string('last_education')->nullable();
            $table->integer('maried_status')->nullable(); //1: belum menikah; 2: menikah; 3: cerai
            $table->integer('profession')->nullable(); //1: utama; 2: tambahan
            $table->integer('family_member')->nullable();
            $table->integer('is_verified')->default(0); //0. baru, 1.verif
            $table->integer('is_import')->default(0); //0. no, 1.yes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaku_usahas');
    }
};
