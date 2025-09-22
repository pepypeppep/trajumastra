<?php

use App\Enums\JenisPenyuluhanStatusEnum;
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
        Schema::create('jadwal_penyuluhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_penyuluhan_id')->index()->nullable();
            $table->foreign('jenis_penyuluhan_id')->references('id')->on('master_jenis_penyuluhans')->onDelete('set null');
            $table->unsignedBigInteger('kategori_id')->index()->nullable();
            $table->foreign('kategori_id')->references('id')->on('master_kategoris')->onDelete('set null');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('quota')->nullable();
            $table->longText('theme')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('status', [
                    JenisPenyuluhanStatusEnum::NEW->value,
                    JenisPenyuluhanStatusEnum::VERIFIED->value,
                    JenisPenyuluhanStatusEnum::REJECTED->value,
                ])->nullable()->default(JenisPenyuluhanStatusEnum::NEW->value);
            $table->string('user_request')->nullable();
            $table->longText('result')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_penyuluhans');
    }
};
