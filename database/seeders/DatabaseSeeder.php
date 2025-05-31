<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Digunakan untuk menghindari event model, namun tidak digunakan di sini.
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Fungsi ini digunakan untuk mengisi (seeding) database dengan data awal.
     * Di sini, kita memanggil beberapa seeder lain yang akan mengisi tabel-tabel terkait.
     */
    public function run(): void
    {
        // Memanggil berbagai seeder untuk mengisi data awal ke dalam tabel yang relevan
        $this->call([
            UserSeeder::class,            // Seeder untuk mengisi data pengguna (user) ke tabel 'users'
            ObatSeeder::class,            // Seeder untuk mengisi data obat ke tabel 'obats'
            JadwalPeriksaSeeder::class,   // Seeder untuk mengisi data jadwal pemeriksaan ke tabel 'jadwal_periksas'
            JanjiPeriksaSeeder::class,    // Seeder untuk mengisi data janji pemeriksaan ke tabel 'janji_periksas'
            PeriksaSeeder::class,         // Seeder untuk mengisi data pemeriksaan ke tabel 'periksas'
            DetailPeriksaSeeder::class,   // Seeder untuk mengisi data detail pemeriksaan ke tabel 'detail_periksas'
            DokterSeeder::class,          // Seeder untuk mengisi data dokter (user dengan peran 'dokter') ke tabel 'users'
        ]);
    }
}
