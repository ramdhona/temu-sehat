<?php

use App\Http\Controllers\Dokter\DokterDashboardController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\PoliController;
use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\Pasien\RiwayatPeriksaController;
use App\Http\Controllers\Dokter\RiwayatController;
use App\Http\Controllers\Pasien\PasienDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route utama (default page)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman dashboard yang hanya bisa diakses oleh pengguna yang sudah login dan terverifikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk mengelola profil pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes untuk role 'dokter'
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {

    // Route untuk dashboard dokter
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');

    // Routes untuk mengelola data 'obat'
    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
        Route::get('/deleted', [ObatController::class, 'deleted'])->name('dokter.obat.deleted');
        Route::get('/restore/{id}', [ObatController::class, 'restore'])->name('dokter.obat.restore');
        Route::delete('/permanent-delete/{id}', [ObatController::class, 'permanentDelete'])->name('dokter.obat.permanentDelete');
    });

    // Routes untuk 'jadwal' (Jadwal Periksa)
    Route::prefix('jadwal')->group(function () {
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal.create');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal.store');
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal.index');
        Route::post('/{id}/status', [JadwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal.status');
        Route::delete('/{id}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal.destroy');
    });

    // Routes untuk 'memeriksa' (Pemeriksaan)
    Route::prefix('memeriksa')->group(function () {
        Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
        Route::get('/periksa/{id}', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
        Route::get('/edit/{id}', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
        Route::post('/update/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
        Route::post('/periksa/{id}/simpan', [MemeriksaController::class, 'simpanPeriksa'])->name('dokter.memeriksa.simpan');
    });

    // Routes untuk 'riwayat-periksa' (Riwayat Pemeriksaan)
    Route::prefix('riwayat-periksa')->group(function () {
        Route::get('/', [RiwayatController::class, 'index'])->name('dokter.riwayat-periksa.index');
        Route::get('/{id}', [RiwayatController::class, 'show'])->name('dokter.riwayat-periksa.show');
    });

    // Routes untuk 'poli' (Poliklinik)
    Route::prefix('poli')->group(function () {
        Route::get('/', [PoliController::class, 'index'])->name('dokter.poli.index');
        Route::get('/create', [PoliController::class, 'create'])->name('dokter.poli.create');
        Route::post('/', [PoliController::class, 'store'])->name('dokter.poli.store');
        Route::get('/{poli}/edit', [PoliController::class, 'edit'])->name('dokter.poli.edit');
        Route::patch('/{poli}', [PoliController::class, 'update'])->name('dokter.poli.update');
        Route::delete('/{poli}', [PoliController::class, 'destroy'])->name('dokter.poli.destroy');
    });
});

// Routes untuk role 'pasien'
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {

    // Route untuk dashboard pasien
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('pasien.dashboard');

    // Routes untuk 'janji-periksa' (Janji Pemeriksaan)
    Route::prefix('janji-periksa')->group(function () {
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
    });

    // Routes untuk 'riwayat-periksa' (Riwayat Pemeriksaan)
    Route::prefix('riwayat-periksa')->group(function () {
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
    });
});

require __DIR__.'/auth.php';
