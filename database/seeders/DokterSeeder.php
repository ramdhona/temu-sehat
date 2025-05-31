<?php

namespace Database\Seeders;

use App\Models\User; // Mengimpor model User untuk menyimpan data pengguna (dokter)
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Mengimpor Hash untuk mengenkripsi password

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'users' dengan data dokter.
     * Di sini, kita membuat beberapa data dokter dengan informasi lengkap.
     */
    public function run(): void
    {
        // Array yang berisi data dokter yang akan dimasukkan ke dalam tabel 'users'
        $dokters = [
            [
                'nama' => 'Dr. Budi Santoso, Sp.PD',
                'email' => 'budi.santoso@klinik.com',
                'password' => Hash::make('dokter123'), // Mengenkripsi password menggunakan Hash
                'role' => 'dokter', // Menetapkan peran pengguna sebagai 'dokter'
                'alamat' => 'Jl. Pahlawan No. 123, Jakarta Selatan',
                'no_ktp' => '3175062505800001',
                'no_hp' => '081234567890',
                'poli' => 'Penyakit Dalam', // Spesialisasi dokter
            ],
            [
                'nama' => 'Dr. Siti Rahayu, Sp.A',
                'email' => 'siti.rahayu@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Anggrek No. 45, Jakarta Pusat',
                'no_ktp' => '3175064610790002',
                'no_hp' => '081234567891',
                'poli' => 'Anak',
            ],
            [
                'nama' => 'Dr. Ahmad Wijaya, Sp.OG',
                'email' => 'ahmad.wijaya@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Melati No. 78, Jakarta Barat',
                'no_ktp' => '3175061505780003',
                'no_hp' => '081234567892',
                'poli' => 'Kebidanan dan Kandungan',
            ],
            [
                'nama' => 'Dr. Rina Putri, Sp.M',
                'email' => 'rina.putri@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Dahlia No. 32, Jakarta Timur',
                'no_ktp' => '3175062708850004',
                'no_hp' => '081234567893',
                'poli' => 'Mata',
            ],
            [
                'nama' => 'Dr. Doni Pratama, Sp.THT',
                'email' => 'doni.pratama@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Kenanga No. 56, Jakarta Utara',
                'no_ktp' => '3175061002820005',
                'no_hp' => '081234567894',
                'poli' => 'THT',
            ],
        ];

        // Looping untuk menyimpan setiap data dokter ke dalam tabel 'users'
        foreach ($dokters as $dokter) {
            // Menggunakan model User untuk menyimpan data dokter
            User::create($dokter);
        }
    }
}
