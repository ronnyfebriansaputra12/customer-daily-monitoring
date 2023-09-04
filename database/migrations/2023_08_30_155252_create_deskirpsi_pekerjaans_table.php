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
            $table->string('deskripsi_pekerjaan');
            $table->string('keterangan')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->enum('status', ['belum konfirmasi', 'sedang dikerjakan','pending', 'selesai'])->nullable();
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
