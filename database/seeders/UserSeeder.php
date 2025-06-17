<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Mengimpor model User untuk mengisi data ke tabel 'users'
use Illuminate\Support\Facades\Hash; // Mengimpor Hash untuk mengenkripsi password (meskipun bcrypt sudah digunakan langsung)
use App\Models\Poli;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini digunakan untuk mengisi tabel 'users' dengan data pengguna (dokter dan pasien).
     * Di sini, kita menambahkan beberapa pengguna yang berbeda, termasuk dokter dan pasien.
     */
    public function run()
    {
        // Seeder untuk data dokter pertama
        User::create([
            'role' => 'dokter',               // Menetapkan peran sebagai dokter
            'nama' => 'Dr. Andi Wijaya',      // Nama dokter
            'email' => 'andi@klinik.test',    // Email dokter
            'password' => bcrypt('password'), // Mengenkripsi password dengan bcrypt
            'alamat' => 'Jl. Kesehatan No. 10', // Alamat dokter
            'no_ktp' => '1234567890123456',   // Nomor KTP dokter
            'no_hp' => '081234567890',        // Nomor HP dokter
            'no_rm' => null,                  // Nomor rekam medis tidak diperlukan untuk dokter
            'poli_id' => Poli::first()->id, // Menetapkan Poli pertama
        ]);

        // Seeder untuk data dokter kedua
        User::create([
            'role' => 'dokter',
            'nama' => 'Dr. Siti Hidayah',
            'email' => 'siti@klinik.test',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Sehat Selalu No. 5',
            'no_ktp' => '2345678901234567',
            'no_hp' => '081298765432',
            'no_rm' => null,
            'poli_id' => Poli::find(2)->id, // Menetapkan Poli kedua
        ]);

        // Seeder untuk data pasien pertama
        User::create([
            'role' => 'pasien',               // Menetapkan peran sebagai pasien
            'nama' => 'Ahmad Fauzi',          // Nama pasien
            'email' => 'ahmad@klinik.test',   // Email pasien
            'password' => bcrypt('password'), // Mengenkripsi password dengan bcrypt
            'alamat' => 'Jl. Melati No. 3',   // Alamat pasien
            'no_ktp' => '3456789012345678',   // Nomor KTP pasien
            'no_hp' => '082134567890',        // Nomor HP pasien
            'no_rm' => 'RM001',               // Nomor rekam medis pasien
            'poli' => null                    // Tidak ada spesialisasi untuk pasien
        ]);

        // Seeder untuk data pasien kedua
        User::create([
            'role' => 'pasien',
            'nama' => 'Rina Kartika',
            'email' => 'rina@klinik.test',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Mawar No. 7',
            'no_ktp' => '4567890123456789',
            'no_hp' => '083245678901',
            'no_rm' => 'RM002',
            'poli' => null
        ]);
    }
}
