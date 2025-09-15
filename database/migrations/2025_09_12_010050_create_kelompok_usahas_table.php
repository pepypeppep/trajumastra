<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Enums\BentukUsahaKelompokUsahaEnum;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelompok_usahas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kalurahan_id')->index()->nullable();
            $table->unsignedBigInteger('kelompok_binaan_id')->nullable()->comment('Relasi ke kelompok binaan | Karena kelompok Usaha merupakan kelompok binaan yang naik level');
            $table->unsignedBigInteger('bentuk_usaha_id')->nullable()->comment('Relasi ke bentuk usaha.');
            $table->string('name')->comment('Nama kelompok Usaha');
            $table->string('address')->nullable()->comment('Alamat Sekretariat kelompok Usaha');
            $table->string('phone')->nullable()->comment('No Telp/HP kelompok Usaha');
            $table->integer('year')->comment('Tahun kelompok Usaha didirikan');
            $table->string('leader')->nullable()->comment('Nama ketua kelompok Usaha');
            $table->integer('members')->nullable()->comment('Jumlah anggota dalam kelompok Usaha');
            $table->string('nib')->nullable()->comment('No. NIB Kelompok Usaha');
            $table->string('income_range')->nullable()->comment('Range Penghasilan Kelompok Usaha');
            $table->timestamps();


            // $table->enum('jenis_kelompok', array_column(JenisKelompokBinaanEnum::cases(), 'value'))->index();
            // $table->unsignedBigInteger('kalurahan_id')->index()->nullable();
            // $table->foreign('kalurahan_id')->references('id')->on('kalurahans')->onDelete('set null');
            // $table->unsignedBigInteger('kecamatan_id')->index()->nullable();
            // $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
            
            // $table->text('market')->nullable()->comment('Kolom untuk menyimpan data pasar, untuk data kelompok Usaha dengan jenis_kelompok = POKLASHAR');
            // $table->string('kusuka_number')->nullable()->comment('No Kartu Pelaku Usaha'); // Saya komen karena masih rancu, apakah no kusuka ini no pelaku usaha yang menjadi ketua dalam kelompok ini ?
            // $table->string('certificate_number')->nullable()->comment('No Akte');
            // $table->string('sk_number')->nullable()->comment('No SK Pengesahan');
            
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
