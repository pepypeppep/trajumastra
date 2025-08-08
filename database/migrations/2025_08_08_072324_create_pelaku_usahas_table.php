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
            $table->unsignedBigInteger('id_desa')->index()->nullable();
            $table->unsignedBigInteger('id_kelompok_binaan')->index()->nullable();
            $table->unsignedBigInteger('id_bentuk_usaha')->index()->nullable();
            $table->unsignedBigInteger('id_jenis_usaha')->index()->nullable();
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
