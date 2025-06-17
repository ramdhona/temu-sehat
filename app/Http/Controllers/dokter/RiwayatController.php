<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User; // Model untuk Pasien
use App\Models\Periksa; // Model untuk Pemeriksaan

class RiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat pemeriksaan untuk semua pasien.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data pasien yang memiliki role 'pasien'
        $pasien = User::where('role', 'pasien')->get();

        // Mengambil semua data riwayat pemeriksaan (sesuaikan dengan kebutuhan)
        $riwayat = Periksa::all(); // Bisa disesuaikan lebih lanjut jika perlu filter

        // Mengirimkan data pasien dan riwayat ke view 'dokter.riwayat.index'
        return view('dokter.riwayat.index', compact('riwayat', 'pasien'));
    }

    /**
     * Menampilkan riwayat pemeriksaan berdasarkan ID pasien.
     *
     * @param int $id ID pasien
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mencari pasien berdasarkan ID yang diberikan
        $pasien = User::findOrFail($id); // Jika tidak ditemukan, akan melemparkan 404 error

        // Mengambil riwayat pemeriksaan berdasarkan ID pasien
        // Melakukan pencarian berdasarkan relasi 'janjiPeriksa' untuk ID pasien yang diberikan
        $riwayat = Periksa::whereHas('janjiPeriksa', function ($query) use ($id) {
            $query->where('id_pasien', $id); // Mengambil riwayat yang terkait dengan pasien tersebut
        })->get();

        // Mengirimkan data pasien dan riwayat pemeriksaan ke view 'dokter.riwayat.show'
        return view('dokter.riwayat.show', compact('pasien', 'riwayat'));
    }
}
