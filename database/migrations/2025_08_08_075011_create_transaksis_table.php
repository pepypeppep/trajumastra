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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->index()->nullable();
            $table->unsignedBigInteger('id_uptd')->index()->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('name');
            $table->string('label'); // uptd : alamat/ tpi : kapal
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('retribution')->default(0);
            $table->bigInteger('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
