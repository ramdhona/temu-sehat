<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use Illuminate\Support\Facades\Auth;

class PasienDashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah riwayat janji periksa yang belum diperiksa
        $belumDiperiksaCount = JanjiPeriksa::where('id_pasien', Auth::id())
            ->whereDoesntHave('periksa') // Mengambil janji periksa yang belum ada riwayat pemeriksaannya
            ->count();

        // Menghitung jumlah riwayat janji periksa yang sudah diperiksa
        $sudahDiperiksaCount = JanjiPeriksa::where('id_pasien', Auth::id())
            ->whereHas('periksa') // Mengambil janji periksa yang sudah ada riwayat pemeriksaannya
            ->count();

        // Mengirimkan jumlah riwayat periksa yang sudah dan belum diperiksa ke view
        return view('pasien.dashboard', compact('belumDiperiksaCount', 'sudahDiperiksaCount'));
    }
}
