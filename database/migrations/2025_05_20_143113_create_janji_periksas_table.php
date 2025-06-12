<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Fungsi ini digunakan untuk membuat tabel di database.
     * Tabel yang akan dibuat adalah 'janji_periksas', yang menyimpan data janji temu pasien untuk pemeriksaan.
     */
    public function up(): void
    {
        Schema::create('janji_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_jadwal_periksa')->constrained('jadwal_periksas')->onDelete('cascade');
            $table->text('keluhan');
            $table->string('no_antrian', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Fungsi ini digunakan untuk membalikkan migrasi, yaitu menghapus tabel yang telah dibuat di fungsi 'up()'.
     * Ini berguna jika kita ingin rollback migrasi.
     */
    public function down(): void
    {
        // Menghapus tabel 'janji_periksas' jika ada
        Schema::dropIfExists('janji_periksas');
    }
};
