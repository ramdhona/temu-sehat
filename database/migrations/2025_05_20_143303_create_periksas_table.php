<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Fungsi ini digunakan untuk membuat tabel 'periksas' di database.
     * Tabel ini digunakan untuk menyimpan informasi tentang pemeriksaan yang dilakukan kepada pasien.
     */
    public function up(): void
    {
        // Membuat tabel 'periksas'
        Schema::create('periksas', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key untuk pemeriksaan
            // Kolom 'id_janji_periksa' yang mengacu pada tabel 'janji_periksas',
            // yang merupakan foreign key untuk menghubungkan pemeriksaan dengan janji temu pasien
            $table->foreignId('id_janji_periksa')->constrained('janji_periksas')->onDelete('cascade');
            // Jika janji temu dihapus, maka semua pemeriksaan terkait juga akan dihapus (cascade).

            $table->datetime('tgl_periksa'); // Kolom untuk menyimpan tanggal dan waktu pemeriksaan
            $table->string('catatan'); // Kolom untuk menyimpan catatan pemeriksaan dari dokter
            $table->integer('biaya_periksa'); // Kolom untuk menyimpan biaya pemeriksaan
            $table->timestamps(); // Kolom untuk mencatat waktu pembuatan dan pembaruan pemeriksaan
        });
    }

    /**
     * Reverse the migrations.
     *
     * Fungsi ini digunakan untuk membalikkan perubahan yang dilakukan oleh fungsi 'up()'.
     * Jika migrasi perlu di-rollback, fungsi ini akan menghapus tabel yang telah dibuat.
     */
    public function down(): void
    {
        // Menghapus tabel 'periksas' jika ada
        Schema::dropIfExists('periksas');
    }
};
