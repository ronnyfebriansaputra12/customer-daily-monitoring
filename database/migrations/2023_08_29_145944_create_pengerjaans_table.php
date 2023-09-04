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
        Schema::create('pengerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('no_working_order');
            $table->string('unit_engine',100);
            $table->string('serial_number',100);
            $table->foreignId('teknisi_id')->constrained('teknisis')->onDelete('cascade');
            $table->foreignId('user_admin_id')->constrained('users')->onDelete('cascade');
            $table->string('deskripsi_pekerjaan')->nullable();
            $table->string('estimasi_pengerjaan')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->enum('status', ['belum konfirmasi', 'sedang dikerjakan','pending', 'selesai'])->nullable();
            $table->timestamps();
            $table->foreign('no_working_order')->references('no_working_order')->on('working_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengerjaans');
    }
};
