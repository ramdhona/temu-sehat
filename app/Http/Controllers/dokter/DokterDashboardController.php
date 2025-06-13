<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\JadwalPeriksa;
use App\Models\User; // Model untuk pasien
use App\Models\JanjiPeriksa; // Model untuk janji periksa
use Illuminate\Support\Facades\Auth;

class DokterDashboardController extends Controller
{
    public function index()
    {
        // Mengambil data statistik untuk ditampilkan di dashboard
        $jumlahObat = Obat::count(); // Jumlah obat yang ada
        $jumlahJadwal = JadwalPeriksa::where('id_dokter', Auth::id())->count(); // Jumlah jadwal periksa untuk dokter yang login
        $jumlahPasien = User::where('role', 'pasien')->count(); // Jumlah pasien

        // Menghitung jumlah pasien yang belum diperiksa
        // Mengambil jumlah pasien yang memiliki JanjiPeriksa, namun belum memiliki pemeriksaan (id_periksa adalah null)
        $jumlahPasienBelumDiperiksa = JanjiPeriksa::whereDoesntHave('periksa')->count();

        // Mengirimkan data statistik ke view
        return view('dokter.dashboard', compact(
            'jumlahObat',
            'jumlahJadwal',
            'jumlahPasien',
            'jumlahPasienBelumDiperiksa'
        ));
    }
}
