<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa; // Model untuk JanjiPeriksa
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan data pengguna yang sedang login

class PasienDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard pasien.
     *
     * Fungsi ini digunakan untuk menghitung jumlah riwayat janji periksa pasien,
     * baik yang sudah diperiksa maupun yang belum diperiksa, dan mengirimkan data tersebut
     * ke halaman dashboard pasien.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menghitung jumlah riwayat janji periksa yang belum diperiksa
        $belumDiperiksaCount = JanjiPeriksa::where('id_pasien', Auth::id()) // Filter berdasarkan ID pasien yang sedang login
            ->whereDoesntHave('periksa') // Menyaring janji periksa yang belum ada pemeriksaannya
            ->count(); // Menghitung jumlah janji periksa yang belum diperiksa

        // Menghitung jumlah riwayat janji periksa yang sudah diperiksa
        $sudahDiperiksaCount = JanjiPeriksa::where('id_pasien', Auth::id()) // Filter berdasarkan ID pasien yang sedang login
            ->whereHas('periksa') // Menyaring janji periksa yang sudah memiliki riwayat pemeriksaan
            ->count(); // Menghitung jumlah janji periksa yang sudah diperiksa

        // Mengirimkan jumlah riwayat periksa yang sudah dan belum diperiksa ke view
        return view('pasien.dashboard', compact('belumDiperiksaCount', 'sudahDiperiksaCount'));
    }
}
