<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPeriksa extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan factory pada model ini
    use HasFactory;

    // Mendefinisikan kolom-kolom yang dapat diisi melalui mass-assignment
    protected $fillable = [
        'id_dokter',    // ID dokter yang terkait dengan jadwal periksa
        'hari',          // Hari dari jadwal periksa
        'jam_mulai',     // Jam mulai jadwal periksa
        'jam_selesai',   // Jam selesai jadwal periksa
        'status',        // Status jadwal (aktif/nonaktif)
    ];

    /**
     * Relasi ke model User (dokter).
     * Setiap JadwalPeriksa berhubungan dengan satu User (dokter) melalui kolom 'id_dokter'.
     *
     * @return BelongsTo
     */
    public function dokter(): BelongsTo
    {
        // Menentukan relasi 'belongsTo' ke model User (dokter) dengan foreign key 'id_dokter'
        return $this->belongsTo(User::class, 'id_dokter');
    }

    /**
     * Relasi ke model JanjiPeriksa.
     * Setiap JadwalPeriksa berhubungan dengan banyak JanjiPeriksa (satu jadwal bisa memiliki banyak janji periksa).
     *
     * @return HasMany
     */
    public function janjiPeriksas(): HasMany
    {
        // Menentukan relasi 'hasMany' ke model JanjiPeriksa dengan foreign key 'id_jadwal_periksa'
        return $this->hasMany(JanjiPeriksa::class, 'id_jadwal_periksa');
    }
}
