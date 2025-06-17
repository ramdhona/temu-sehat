<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung pembuatan factory

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = ['nama_poli']; // Kolom yang dapat diisi menggunakan mass assignment adalah 'nama_poli'

    /**
     * Relasi antara Poli dan User (Dokter).
     * Setiap Poli dapat memiliki banyak Dokter (User dengan role 'dokter').
     * 
     * Fungsi ini mendefinisikan relasi one-to-many antara model Poli dan model User.
     * Artinya, satu Poli bisa memiliki banyak Dokter yang terhubung dengan pola relasi ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        // Mengembalikan relasi hasMany antara Poli dan User
        // Di sini, setiap Poli bisa memiliki banyak User yang berperan sebagai Dokter
        return $this->hasMany(User::class); // Menghubungkan dengan model User (dokter)
    }
}
