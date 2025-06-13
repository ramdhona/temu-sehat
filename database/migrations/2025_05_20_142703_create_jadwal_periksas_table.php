<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPeriksasTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dokter')->constrained('users')->onDelete('cascade');
            $table->string('hari'); // Untuk menyimpan hari (Senin, Selasa, etc.)
            $table->time('jam_mulai'); // Untuk menyimpan jam mulai
            $table->time('jam_selesai'); // Untuk menyimpan jam selesai
            $table->integer('status')->default(0); // 0 = nonaktif, 1 = aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_periksas');
    }
}
