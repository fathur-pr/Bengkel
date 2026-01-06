<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Siapa yang booking? (Terhubung ke tabel users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Detail Servis
            $table->string('nama_mobil'); // Cth: Toyota Avanza
            $table->string('jenis_servis'); // Cth: Ganti Oli, Tune Up
            $table->datetime('tanggal_booking'); // Kapan mau datang?
            $table->text('catatan')->nullable(); // Keluhan tambahan
            
            // Status (Pending, Diproses, Selesai)
            $table->string('status')->default('pending'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};