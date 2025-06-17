<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class JanjiPeriksa extends Model
{
    // Menentukan kolom tanggal periksa yang harus diperlakukan sebagai instansi Carbon (untuk manipulasi tanggal)
    protected $dates = ['tgl_periksa'];

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'janji_periksas';

    // Mendefinisikan kolom-kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'id_pasien',      // ID pasien yang membuat janji periksa
        'id_jadwal_periksa',  // ID jadwal periksa yang dipilih pasien
        'status',         // Status janji periksa (misal: aktif atau selesai)
        'keluhan',        // Keluhan yang disampaikan oleh pasien
        'no_antrian',     // Nomor antrian pasien untuk pemeriksaan
    ];

    /**
     * Relasi ke model Pasien.
     * Setiap JanjiPeriksa berhubungan dengan satu pasien melalui foreign key 'id_pasien'.
     *
     * @return BelongsTo
     */
    public function pasien(): BelongsTo
    {
        // Relasi BelongsTo menghubungkan JanjiPeriksa dengan model User (Pasien) melalui 'id_pasien'
        return $this->belongsTo(User::class, 'id_pasien');
    }

    /**
     * Relasi ke model JadwalPeriksa.
     * Setiap JanjiPeriksa berhubungan dengan satu JadwalPeriksa melalui foreign key 'id_jadwal_periksa'.
     *
     * @return BelongsTo
     */
    public function jadwalPeriksa(): BelongsTo
    {
        // Relasi BelongsTo menghubungkan JanjiPeriksa dengan JadwalPeriksa melalui 'id_jadwal_periksa'
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa');
    }

    /**
     * Relasi ke model Periksa.
     * Setiap JanjiPeriksa dapat memiliki satu pemeriksaan (Periksa).
     * Relasi ini menggunakan HasOne karena satu JanjiPeriksa hanya memiliki satu Periksa.
     *
     * @return HasOne
     */
    public function periksa(): HasOne
    {
        // Relasi HasOne menghubungkan JanjiPeriksa dengan model Periksa melalui 'id_janji_periksa'
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }

    /**
     * Relasi untuk mendapatkan semua obat yang terkait dengan JanjiPeriksa.
     * Relasi ini dilakukan melalui model perantara (DetailPeriksa) yang menghubungkan Periksa dengan Obat.
     * 
     * @return HasManyThrough
     */
    public function obats(): HasManyThrough
    {
        // Relasi HasManyThrough memungkinkan kita untuk mengakses Obat yang terkait melalui DetailPeriksa dan Periksa
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
