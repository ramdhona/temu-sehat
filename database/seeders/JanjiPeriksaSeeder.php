<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JanjiPeriksa; // Mengimpor model JanjiPeriksa untuk membuat janji pemeriksaan
use App\Models\User;        // Mengimpor model User untuk mengambil data pasien
use App\Models\JadwalPeriksa; // Mengimpor model JadwalPeriksa untuk mengambil data jadwal pemeriksaan

class JanjiPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'janji_periksas' dengan data janji temu pasien.
     * Di sini, kita mengambil data pasien dan jadwal pemeriksaan yang ada,
     * kemudian membuat janji pemeriksaan untuk pasien tersebut.
     */
    public function run()
    {
        // Mengambil pasien pertama dengan peran 'pasien' dari tabel 'users'
        $pasien = User::where('role', 'pasien')->first();

        // Mengambil jadwal pertama dari tabel 'jadwal_periksas'
        $jadwal = JadwalPeriksa::first();

        // Membuat janji pemeriksaan untuk pasien pada jadwal yang sudah dipilih
        JanjiPeriksa::create([
            'id_pasien' => $pasien->id,  // Menghubungkan janji temu dengan ID pasien
            'id_jadwal' => $jadwal->id,  // Menghubungkan janji temu dengan ID jadwal pemeriksaan
            'keluhan' => 'Sakit kepala dan demam', // Keluhan pasien yang disampaikan saat membuat janji
            'no_antrian' => 1, // Nomor antrian pasien untuk jadwal pemeriksaan tersebut
        ]);
    }
}
