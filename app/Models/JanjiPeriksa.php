<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JanjiPeriksa extends Model
{
    // Menentukan nama tabel yang digunakan dalam model ini
    protected $table = 'janji_periksas';

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'id_pasien',      // ID pasien yang membuat janji
        'id_jadwal',      // ID jadwal yang dipilih oleh pasien
        'status',         // Status janji (misalnya: 'terkonfirmasi', 'dibatalkan', dll)
        'tanggal_periksa',// Tanggal pemeriksaan yang dijadwalkan
        'keluhan',        // Keluhan yang disampaikan oleh pasien
    ];

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model User (Pasien).
     * Setiap JanjiPeriksa berhubungan dengan satu entri dalam tabel User (Pasien).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien()
    {
        // Menghubungkan model JanjiPeriksa dengan model User (Pasien) berdasarkan 'id_pasien'
        return $this->belongsTo(User::class, 'id_pasien');
    }

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model JadwalPeriksa.
     * Setiap JanjiPeriksa berhubungan dengan satu entri dalam tabel JadwalPeriksa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal()
    {
        // Menghubungkan model JanjiPeriksa dengan model JadwalPeriksa berdasarkan 'id_jadwal'
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    /**
     * Menentukan hubungan satu ke satu (HasOne) dengan model Periksa.
     * Setiap JanjiPeriksa berhubungan dengan satu entri dalam tabel Periksa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function periksa()
    {
        // Menghubungkan model JanjiPeriksa dengan model Periksa berdasarkan 'id_janji_periksa'
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }
}
