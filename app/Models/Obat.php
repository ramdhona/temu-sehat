<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Menambahkan trait SoftDeletes untuk mendukung fitur soft delete

class Obat extends Model
{
    use SoftDeletes; // Menggunakan trait SoftDeletes agar model ini mendukung fitur soft delete

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'obats'; // Nama tabel yang digunakan untuk model Obat adalah 'obats'

    // Mendefinisikan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_obat', // Nama obat
        'kemasan',   // Kemasan obat
        'harga',     // Harga obat
    ];

    // Mendefinisikan kolom yang digunakan untuk soft delete.
    // Secara default, Laravel menggunakan "deleted_at" untuk menandai data yang dihapus secara soft delete
    protected $dates = ['deleted_at']; // Menandakan kolom deleted_at untuk menyimpan tanggal dan waktu soft delete

    /**
     * Relasi ke model DetailPeriksa.
     * Setiap Obat bisa memiliki banyak DetailPeriksa yang menghubungkannya dengan Periksa.
     * Fungsi ini mendefinisikan relasi one-to-many antara Obat dan DetailPeriksa.
     *
     * @return HasMany
     */
    public function detailPeriksas()
    {
        // Mengembalikan relasi HasMany antara Obat dan DetailPeriksa.
        // Obat dapat memiliki banyak DetailPeriksa yang dihubungkan dengan kolom 'id_obat' di tabel DetailPeriksa
        return $this->hasMany(DetailPeriksa::class, 'id_obat'); // Relasi ke model DetailPeriksa dengan 'id_obat' sebagai foreign key
    }
}
