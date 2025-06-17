<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Periksa extends Model
{
    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'periksas';

    // Menambahkan kolom 'tgl_periksa' agar dikonversi menjadi objek Carbon
    protected $dates = ['tgl_periksa']; // Kolom tgl_periksa akan secara otomatis dikonversi ke objek Carbon

    // Menentukan kolom-kolom yang dapat diisi melalui mass-assignment
    protected $fillable = [
        'id_janji_periksa', // ID janji periksa yang berhubungan dengan pemeriksaan
        'tgl_periksa',      // Tanggal pemeriksaan
        'catatan',          // Catatan medis untuk pemeriksaan
        'id_obat',          // ID obat yang digunakan dalam pemeriksaan
        'diagnosa',         // Diagnosa yang diberikan pada pasien
        'tindakan',         // Tindakan medis yang dilakukan
        'resep',            // Resep yang diberikan
        'biaya',            // Biaya total pemeriksaan
        'biaya_periksa',    // Biaya pemeriksaan tanpa obat
    ];

    /**
     * Relasi ke model JanjiPeriksa
     * Setiap pemeriksaan (Periksa) berhubungan dengan satu janji periksa (JanjiPeriksa)
     *
     * @return BelongsTo
     */
    public function janjiPeriksa(): BelongsTo
    {
        return $this->belongsTo(JanjiPeriksa::class, 'id_janji_periksa');
    }

    /**
     * Relasi ke model DetailPeriksa
     * Setiap pemeriksaan bisa memiliki banyak detail pemeriksaan (DetailPeriksa)
     *
     * @return HasMany
     */
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    /**
     * Relasi ke model Obat
     * Banyak obat yang digunakan dalam satu pemeriksaan. 
     * Relasi ini menghubungkan Periksa dengan Obat melalui tabel pivot 'detail_periksas'
     *
     * @return BelongsToMany
     */
    public function obats(): BelongsToMany
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }
}
