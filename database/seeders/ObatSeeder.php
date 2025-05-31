<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat; // Mengimpor model Obat untuk mengisi data ke tabel 'obats'

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'obats' dengan data obat-obatan.
     * Di sini, kita menyisipkan beberapa data obat seperti nama, kemasan, dan harga obat.
     */
    public function run()
    {
        // Menyisipkan beberapa data obat ke dalam tabel 'obats' menggunakan insert()
        Obat::insert([
            [
                'nama_obat' => 'Paracetamol',  // Nama obat
                'kemasan' => 'Tablet 500mg',   // Kemasan obat
                'harga' => 5000,               // Harga obat dalam satuan rupiah
            ],
            [
                'nama_obat' => 'Amoxicillin',  // Nama obat
                'kemasan' => 'Kapsul 250mg',   // Kemasan obat
                'harga' => 8000,               // Harga obat dalam satuan rupiah
            ],
            [
                'nama_obat' => 'Vitamin C',   // Nama obat
                'kemasan' => 'Tablet 100mg',  // Kemasan obat
                'harga' => 3000,              // Harga obat dalam satuan rupiah
            ]
        ]);
    }
}
