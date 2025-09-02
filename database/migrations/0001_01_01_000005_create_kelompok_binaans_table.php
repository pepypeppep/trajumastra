<?php

use App\Enums\JenisKelompokBinaanEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelompok_binaans', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_kelompok', array_column(JenisKelompokBinaanEnum::cases(), 'value'))->index();
            $table->unsignedBigInteger('kalurahan_id')->index()->nullable();
            $table->foreign('kalurahan_id')->references('id')->on('kalurahans')->onDelete('set null');
            $table->string('name')->comment('Nama kelompok binaan');
            $table->string('address')->nullable()->comment('Alamat Sekretariat kelompok binaan');
            $table->string('phone')->nullable()->comment('No Telp/HP kelompok binaan');
            $table->integer('year')->comment('Tahun kelompok binaan didirikan');
            $table->string('leader')->nullable()->comment('Nama ketua kelompok binaan');
            $table->integer('members')->nullable()->comment('Jumlah anggota dalam kelompok binaan');
            $table->text('market')->nullable()->comment('Kolom untuk menyimpan data pasar, untuk data kelompok binaan dengan jenis_kelompok = POKLASHAR');
            // $table->string('kusuka_number')->nullable()->comment('No Kartu Pelaku Usaha'); // Saya komen karena masih rancu, apakah no kusuka ini no pelaku usaha yang menjadi ketua dalam kelompok ini ?
            $table->string('certificate_number')->nullable()->comment('No Akte');
            $table->string('sk_number')->nullable()->comment('No SK Pengesahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_binaans');
    }
};
