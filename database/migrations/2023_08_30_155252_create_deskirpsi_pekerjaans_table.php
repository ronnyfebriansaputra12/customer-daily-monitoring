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
        Schema::create('deskirpsi_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengerjaan_id')->constrained('pengerjaans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('deskripsi_pekerjaan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('catatan')->nullable();
            $table->date('tanggal_mulai_pengerjaan')->nullable();
            $table->date('tanggal_selesai_perpengerjaan')->nullable();
            $table->enum('status', ['belum konfirmasi', 'sedang dikerjakan','pending', 'selesai'])->nullable();
            $table->enum('status_perpengerjaan', ['belum dikerjakan','sedang dikerjakan','pending','selesai'])->default('belum dikerjakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deskirpsi_pekerjaans');
    }
};
