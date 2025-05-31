<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    // Menentukan nama tabel yang digunakan dalam model ini
    protected $table = 'detail_periksas';

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'id_periksa',  // ID pemeriksaan yang terkait
        'id_obat',     // ID obat yang digunakan
        'jumlah',      // Jumlah obat yang diberikan
        'biaya',       // Biaya obat yang digunakan dalam pemeriksaan
    ];

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model Periksa.
     * Setiap DetailPeriksa berhubungan dengan satu entri dalam tabel Periksa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periksa()
    {
        // Menghubungkan model DetailPeriksa dengan model Periksa berdasarkan 'id_periksa'
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model Obat.
     * Setiap DetailPeriksa berhubungan dengan satu entri dalam tabel Obat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function obat()
    {
        // Menghubungkan model DetailPeriksa dengan model Obat berdasarkan 'id_obat'
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
