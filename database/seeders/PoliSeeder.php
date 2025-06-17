<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        Poli::create([
            'nama_poli' => 'Poli Umum',
        ]);

        Poli::create([
            'nama_poli' => 'Poli Gigi',
        ]);

        Poli::create([
            'nama_poli' => 'Poli Kandungan',
        ]);

        // Tambahkan poli lainnya sesuai kebutuhan
    }
}
