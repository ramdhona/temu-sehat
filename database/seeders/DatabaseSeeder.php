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
        $this->call([
            UserSeeder::class,
            ObatSeeder::class,
            JadwalPeriksaSeeder::class,
        ]);
    }
}
