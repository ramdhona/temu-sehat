<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Mengimpor model User untuk mengambil data dokter
use App\Models\JadwalPeriksa; // Mengimpor model JadwalPeriksa untuk menyimpan jadwal periksa dokter

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'jadwal_periksas' dengan data jadwal pemeriksaan dokter.
     */
    public function run()
    {
        // Mengambil dokter pertama dengan peran 'dokter' dari tabel 'users'
        $dokter1 = User::where('role', 'dokter')->first();

        // Menyisipkan data jadwal pemeriksaan dokter ke dalam tabel 'jadwal_periksas'
        JadwalPeriksa::insert([
            [
                'id_dokter' => $dokter1->id, // Menyimpan ID dokter yang diambil dari dokter pertama
                'hari' => 'Senin',            // Hari jadwal pemeriksaan
                'jam_mulai' => '08:00:00',    // Jam mulai pemeriksaan
                'jam_selesai' => '12:00:00',  // Jam selesai pemeriksaan
            ],
            [
                'id_dokter' => $dokter1->id, // Menyimpan ID dokter yang sama untuk jadwal berikutnya
                'hari' => 'Rabu',             // Hari jadwal pemeriksaan
                'jam_mulai' => '13:00:00',   // Jam mulai pemeriksaan
                'jam_selesai' => '17:00:00', // Jam selesai pemeriksaan
            ]
        ]);
    }
}
