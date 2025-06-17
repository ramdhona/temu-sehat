<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Membuat tabel 'polis'
        Schema::create('polis', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk Poli
            $table->string('nama_poli'); // Kolom untuk nama poli
            $table->timestamps(); // Kolom untuk mencatat waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Menghapus tabel 'polis' jika migration di-rollback
        Schema::dropIfExists('polis');
    }
}
