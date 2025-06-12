<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Periksa extends Model
{
    protected $table = 'periksas';

    // Menambahkan kolom 'tgl_periksa' untuk dikonversi menjadi objek Carbon
    protected $dates = ['tgl_periksa']; // Kolom tgl_periksa akan menjadi objek Carbon

    protected $fillable = [
        'id_janji_periksa',
        'tgl_periksa',
        'catatan',
        'id_obat',
        'diagnosa',
        'tindakan',
        'resep',
        'biaya',
        'biaya_periksa',
    ];

    // Relasi ke model JanjiPeriksa (satu pemeriksaan milik satu janji periksa)
    public function janjiPeriksa(): BelongsTo
    {
        return $this->belongsTo(JanjiPeriksa::class, 'id_janji_periksa');
    }

    // Relasi ke model DetailPeriksa (satu pemeriksaan dapat memiliki banyak detail)
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    // Relasi ke model Obat (banyak obat dapat digunakan dalam satu pemeriksaan)
    public function obats(): BelongsToMany
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }
}
