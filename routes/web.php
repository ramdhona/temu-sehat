<?php

use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\dokter\MemeriksaController;
use App\Http\Controllers\dokter\ObatController;
use App\Http\Controllers\pasien\JanjiPeriksaController;
use App\Http\Controllers\pasien\RiwayatPeriksaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\callback;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // Routes for 'obat'
    Route::prefix('obat')->group(function () {
        // View all obat
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');

        // Create new obat
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');

        // Store new obat (post request)
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');

        // Edit existing obat
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');

        // Update existing obat (patch request)
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');

        // Delete an obat
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });

    // Routes for 'jadwal' (Schedule)
    Route::prefix('jadwal')->group(function () {
        // Rute untuk membuat jadwal
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal.create');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal.store');

        // Rute untuk melihat dan mengelola jadwal
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal.index');
        Route::post('/{id}/status', [JadwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal.status');
        Route::delete('/{id}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal.destroy');
    });

     Route::prefix('memeriksa')->group(callback:function () {
        Route::get(uri: '/',action:[MemeriksaController::class, 'index'])->name(name: 'dokter.memeriksa.index');
        Route::get(uri: '/periksa',action:[MemeriksaController::class, 'periksa'])->name(name: 'dokter.memeriksa.periksa');
        Route::get(uri: '/edit',action:[MemeriksaController::class, 'edit'])->name(name: 'dokter.memeriksa.edit');


    });
});



  Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
    // Menambahkan rute untuk janji periksa
    Route::prefix('janji-periksa')->group(function(){
            Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
            Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
        });
     Route::prefix('riwayat-periksa')->group(function(){
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
    });

});    

require __DIR__.'/auth.php';
