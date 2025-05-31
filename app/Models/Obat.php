<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    // Menentukan nama tabel yang digunakan dalam model ini
    protected $table = 'obats';

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'nama_obat',  // Nama obat yang dijual
        'kemasan',    // Kemasan obat (misalnya botol, box, dll.)
        'harga',      // Harga obat
    ];

    /**
     * Menentukan hubungan satu ke banyak (HasMany) dengan model DetailPeriksa.
     * Setiap Obat dapat digunakan dalam banyak pemeriksaan, yang dicatat di DetailPeriksa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPeriksa()
    {
        // Menghubungkan model Obat dengan model DetailPeriksa berdasarkan 'id_obat'
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }
}
