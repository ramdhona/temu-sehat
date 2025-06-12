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
        Schema::create('jadwal_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dokter')->constrained('users')->onDelete('cascade');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('status');
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
