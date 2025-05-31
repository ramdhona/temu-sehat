<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periksa;        // Mengimpor model Periksa untuk menyimpan data pemeriksaan
use App\Models\JanjiPeriksa;   // Mengimpor model JanjiPeriksa untuk mengambil data janji pemeriksaan

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'periksas' dengan data pemeriksaan.
     * Di sini, kita mengambil data janji periksa yang ada, kemudian membuat data pemeriksaan untuk janji tersebut.
     */
    public function run()
    {
        // Mengambil janji periksa pertama dari tabel 'janji_periksas'
        $janji = JanjiPeriksa::first();

        // Membuat data pemeriksaan baru berdasarkan janji periksa yang diambil
        Periksa::create([
            'id_janji_periksa' => $janji->id, // Menghubungkan pemeriksaan dengan janji periksa
            'tgl_periksa' => now(),           // Menyimpan tanggal dan waktu pemeriksaan saat ini
            'catatan' => 'Diagnosa: flu ringan. Disarankan istirahat & minum obat.', // Catatan hasil pemeriksaan
            'biaya_periksa' => 25000          // Biaya pemeriksaan
        ]);
    }
}
