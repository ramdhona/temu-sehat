<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Fungsi ini digunakan untuk membuat tabel 'detail_periksas' di database.
     * Tabel ini menyimpan informasi detail dari pemeriksaan, seperti obat yang digunakan selama pemeriksaan.
     */
    public function up(): void
    {
        // Membuat tabel 'detail_periksas'
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key untuk detail pemeriksaan

            // Kolom 'id_periksa' yang mengacu pada tabel 'periksas',
            // yang merupakan foreign key untuk menghubungkan detail pemeriksaan dengan pemeriksaan tertentu
            $table->foreignId('id_periksa')->constrained('periksas')->onDelete('cascade');
            // Jika pemeriksaan dihapus, maka semua detail pemeriksaan terkait juga akan dihapus (cascade).

            // Kolom 'id_obat' yang mengacu pada tabel 'obats',
            // yang merupakan foreign key untuk menghubungkan detail pemeriksaan dengan obat yang digunakan
            $table->foreignId('id_obat')->constrained('obats')->onDelete('cascade');
            // Jika obat yang terkait dihapus, maka detail pemeriksaan terkait dengan obat tersebut juga akan dihapus (cascade).

            // Kolom untuk mencatat waktu pembuatan dan pembaruan detail pemeriksaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Fungsi ini digunakan untuk membalikkan migrasi, yaitu menghapus tabel yang telah dibuat di fungsi 'up()'.
     * Fungsi ini berguna jika kita ingin rollback migrasi.
     */
    public function down(): void
    {
        // Menghapus tabel 'detail_periksas' jika ada
        Schema::dropIfExists('detail_periksas');
    }
};
