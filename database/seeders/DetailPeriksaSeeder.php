<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Obat;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'detail_periksas' dengan data.
     * Di sini, kita mengambil data pemeriksaan dan obat yang sudah ada, kemudian membuat data detail pemeriksaan.
     */
    public function run()
    {
        // Mengambil entri pertama dari tabel 'periksas'
        $periksa = Periksa::first();

        // Mengambil entri pertama dari tabel 'obats'
        $obat = Obat::first();

        // Membuat entri baru di tabel 'detail_periksas' dengan menghubungkan 'periksa' dan 'obat'
        DetailPeriksa::create([
            'id_periksa' => $periksa->id,  // Menghubungkan dengan ID pemeriksaan
            'id_obat' => $obat->id        // Menghubungkan dengan ID obat
        ]);
    }
}
