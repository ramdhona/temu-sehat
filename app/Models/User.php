<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // Menggunakan trait HasFactory untuk mendukung pembuatan objek User menggunakan factory.
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * Kolom yang dapat diisi secara massal (mass assignment). Ini memastikan kolom ini dapat diisi dengan data pengguna secara aman.
     *
     * @var list<string>
     */
    protected $table = 'users'; // Nama tabel yang digunakan oleh model ini (users).

    protected $fillable = [
        'nama',         // Nama pengguna
        'role',         // Peran pengguna (dokter, pasien, dll.)
        'alamat',       // Alamat pengguna
        'no_hp',        // Nomor HP pengguna
        'no_ktp',       // Nomor KTP pengguna
        'no_rm',        // Nomor rekam medis (jika pasien)
        'poli',         // Poli yang dipilih oleh pasien (jika pasien)
        'email',        // Alamat email pengguna
        'password',     // Password pengguna (ter-enkripsi)
    ];

    /**
     * Menentukan hubungan satu ke banyak (HasMany) dengan model JadwalPeriksa.
     * Setiap User dengan peran 'dokter' dapat memiliki banyak jadwal pemeriksaan yang terjadwal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwalPeriksa()
    {
        // Menghubungkan model User dengan model JadwalPeriksa berdasarkan 'id_dokter'
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    /**
     * Menentukan hubungan satu ke banyak (HasMany) dengan model JanjiPeriksa.
     * Setiap User dengan peran 'pasien' dapat memiliki banyak janji pemeriksaan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function janjiPerika()
    {
        // Menghubungkan model User dengan model JanjiPeriksa berdasarkan 'id_pasien'
        return $this->hasMany(JanjiPeriksa::class, 'id_pasien');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * Menentukan atribut mana yang harus disembunyikan ketika data pengguna diserialisasi (misalnya, saat dikirim sebagai JSON).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',      // Password disembunyikan untuk alasan keamanan
        'remember_token',// Token untuk "remember me" disembunyikan
    ];

    /**
     * Get the attributes that should be cast.
     *
     * Mengonversi atribut tertentu ke dalam tipe data lain saat diakses, misalnya untuk memastikan format waktu yang benar atau penyimpanan password yang terenkripsi.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Mengonversi atribut 'email_verified_at' ke tipe datetime
            'password' => 'hashed',            // Mengonversi password menjadi hashed (terenkripsi)
        ];
    }
}
