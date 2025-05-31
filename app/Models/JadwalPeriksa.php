<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    // Menentukan nama tabel yang digunakan dalam model ini
    protected $table = 'jadwal_periksas';

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'id_dokter',   // ID dokter yang bertugas pada jadwal ini
        'hari',         // Hari jadwal pemeriksaan
        'jam_mulai',    // Jam mulai pemeriksaan
        'jam_selesai',  // Jam selesai pemeriksaan
    ];

    /**
     * Menentukan hubungan satu ke banyak (BelongsTo) dengan model User (Dokter).
     * Setiap JadwalPeriksa berhubungan dengan satu entri dalam tabel User (dokter).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter()
    {
        // Menghubungkan model JadwalPeriksa dengan model User (dokter) berdasarkan 'id_dokter'
        return $this->belongsTo(User::class, 'id_dokter');
    }

    /**
     * Menentukan hubungan satu ke banyak (HasMany) dengan model JanjiPeriksa.
     * Setiap JadwalPeriksa dapat memiliki banyak JanjiPeriksa yang terjadwal untuk jadwal ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function janjiPeriksa()
    {
        // Menghubungkan model JadwalPeriksa dengan model JanjiPeriksa berdasarkan 'id_jadwal'
        return $this->hasMany(JanjiPeriksa::class, 'id_jadwal');
    }
}
