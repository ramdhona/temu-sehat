<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class JanjiPeriksa extends Model
{
    protected $dates = ['tgl_periksa'];
    protected $table = 'janji_periksas';
    protected $fillable = [
        'id_pasien',
        'id_jadwal_periksa',
        'status',
        'keluhan',
        'no_antrian',
    ];

    // Relasi ke model Pasien
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    // Relasi ke model JadwalPeriksa
    public function jadwalPeriksa(): BelongsTo
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa');
    }

    // Relasi ke model Periksa (satu janji periksa dapat memiliki satu pemeriksaan)
    public function periksa(): HasOne
    {
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }

    // Relasi untuk mendapatkan semua obat yang terkait dengan janji periksa melalui Periksa dan DetailPeriksa
    public function obats(): HasManyThrough
    {
        return $this->hasManyThrough(
            Obat::class,             // Model yang ingin diakses (Obat)
            DetailPeriksa::class,    // Model perantara (DetailPeriksa)
            'id_periksa',            // Foreign key pada DetailPeriksa yang mengarah ke Periksa
            'id',                    // Foreign key pada Obat yang mengarah ke DetailPeriksa
            'id',                    // Local key pada JanjiPeriksa
            'id_obat'                // Local key pada DetailPeriksa yang mengarah ke id Obat
        );
    }
}
