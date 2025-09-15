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
        Schema::create('master_jenis_ikans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('image')->nullable();
            $table->integer('type')->nullable(); //1: tpi; 2: uptd
            $table->integer('economic_value')->nullable(); //1: rendah; 2: sedang; 3: tinggi
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jenis_ikans');
    }
};
