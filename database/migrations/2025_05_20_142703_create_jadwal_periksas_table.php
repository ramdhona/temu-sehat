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
     * Tabel yang akan dibuat adalah 'jadwal_periksas' yang menyimpan jadwal pemeriksaan dokter.
     */
    public function up(): void
    {
        // Membuat tabel 'jadwal_periksas'
        Schema::create('jadwal_periksas', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            $table->foreignId('id_dokter')->constrained('users')->onDelete('cascade'); // Kolom 'id_dokter' yang mengacu pada tabel 'users' (dokter)
            // Menggunakan 'foreignId' untuk membuat relasi dengan tabel 'users' (dokter). Jika dokter dihapus, maka jadwal periksa terkait juga akan dihapus (cascade).

            // Kolom 'hari' yang berisi hari dalam seminggu, dengan nilai yang terbatas menggunakan enum
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);

            // Kolom 'jam_mulai' dan 'jam_selesai' untuk menyimpan waktu mulai dan waktu selesai pemeriksaan
            $table->time('jam_mulai'); // Kolom waktu mulai pemeriksaan
            $table->time('jam_selesai'); // Kolom waktu selesai pemeriksaan

            // Kolom waktu pembuatan dan pembaruan secara otomatis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Fungsi ini digunakan untuk membalikkan/menghapus perubahan yang dilakukan pada fungsi 'up()'.
     * Jika migrasi di-rollback, tabel 'jadwal_periksas' akan dihapus.
     */
    public function down(): void
    {
        // Menghapus tabel 'jadwal_periksas' jika diperlukan
        Schema::dropIfExists('jadwal_periksas');
    }
};
