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
        // Membuat tabel 'janji_periksas'
        Schema::create('janji_periksas', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade'); // Kolom 'id_pasien' yang mengacu pada tabel 'users' (pasien). Jika pasien dihapus, janji temu terkait juga akan dihapus.
            $table->foreignId('id_jadwal')->constrained('jadwal_periksas')->onDelete('cascade'); // Kolom 'id_jadwal' yang mengacu pada tabel 'jadwal_periksas'. Jika jadwal periksa dihapus, janji temu terkait juga akan dihapus.
            $table->text('keluhan'); // Kolom untuk menyimpan keluhan yang disampaikan oleh pasien
            $table->integer('no_antrian'); // Kolom untuk menyimpan nomor antrian pasien pada jadwal pemeriksaan
            $table->timestamps(); // Kolom untuk mencatat waktu pembuatan dan pembaruan janji temu
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
