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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_level')->index()->nullable();
            $table->unsignedBigInteger('id_bidang')->index()->nullable();
            $table->unsignedBigInteger('id_penyuluh')->index()->nullable();
            $table->unsignedBigInteger('id_pelaku_usaha')->index()->nullable();
            $table->unsignedBigInteger('id_koordinator_uptds')->index()->nullable();
            $table->unsignedBigInteger('id_uptd')->index()->nullable();
            // $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('last_login')->nullable();
            $table->integer('status')->default(1); // 1: active, 0: inactive
            $table->string('reset_password')->nullable();
            $table->timestamps();

            // $table->foreign('id_user_level')->references('id')->on('user_levels');
            // $table->foreign('id_bidang')->references('id')->on('master_bidangs');
            // $table->foreign('id_penyuluh')->references('id')->on('penyuluhs');
            // $table->foreign('id_pelaku_usaha')->references('id')->on('pelaku_usahas');
            // $table->foreign('id_koordinator_uptds')->references('id')->on('koordinator_uptds');
            // $table->foreign('id_uptd')->references('id')->on('uptds');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
