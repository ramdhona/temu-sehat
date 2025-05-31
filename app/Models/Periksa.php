<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    // Menentukan nama tabel yang digunakan dalam model ini
    protected $table = 'periksas';

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'id_janji_periksa',  // ID janji periksa yang mengaitkan pemeriksaan dengan janji temu pasien
        'id_obat',           // ID obat yang digunakan dalam pemeriksaan
        'diagnosa',          // Diagnosa dokter setelah memeriksa pasien
        'tindakan',          // Tindakan medis yang dilakukan selama pemeriksaan
        'resep',             // Resep obat yang diberikan kepada pasien
        'biaya',             // Biaya pemeriksaan
    ];

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model JanjiPeriksa.
     * Setiap Periksa berhubungan dengan satu entri dalam tabel JanjiPeriksa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function janjiPeriksa()
    {
        // Menghubungkan model Periksa dengan model JanjiPeriksa berdasarkan 'id_janji_periksa'
        return $this->belongsTo(JanjiPeriksa::class, 'id_janji_periksa');
    }

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model Obat.
     * Setiap Periksa berhubungan dengan satu entri dalam tabel Obat yang digunakan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function obat()
    {
        // Menghubungkan model Periksa dengan model Obat berdasarkan 'id_obat'
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    /**
     * Menentukan hubungan satu ke banyak (HasMany) dengan model DetailPeriksa.
     * Setiap Periksa dapat memiliki banyak DetailPeriksa yang terkait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPeriksa()
    {
        // Menghubungkan model Periksa dengan model DetailPeriksa berdasarkan 'id_periksa'
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}
