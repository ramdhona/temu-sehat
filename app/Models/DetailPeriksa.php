<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPeriksa extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan factory pada model ini
    use HasFactory;

    // Mendefinisikan kolom-kolom yang dapat diisi melalui mass-assignment
    protected $fillable = [
        'id_periksa',  // ID dari pemeriksaan yang terkait
        'id_obat',     // ID dari obat yang terkait
    ];

    /**
     * Relasi ke model Periksa (satu DetailPeriksa berhubungan dengan satu Periksa).
     * Menggunakan foreign key 'id_periksa' yang mengacu pada model Periksa.
     *
     * @return BelongsTo
     */
    public function periksa(): BelongsTo
    {
        // Menentukan relasi 'belongsTo' ke model Periksa
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }

    /**
     * Relasi ke model Obat (satu DetailPeriksa berhubungan dengan satu Obat).
     * Menggunakan foreign key 'id_obat' yang mengacu pada model Obat.
     *
     * @return BelongsTo
     */
    public function obat(): BelongsTo
    {
        // Menentukan relasi 'belongsTo' ke model Obat
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
