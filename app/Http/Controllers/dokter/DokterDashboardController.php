<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\JadwalPeriksa;
use App\Models\User; 
use App\Models\JanjiPeriksa; 
use Illuminate\Support\Facades\Auth;

class DokterDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data statistik untuk dokter yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil jumlah obat yang terdaftar
        $jumlahObat = $this->getJumlahObat();

        // Mengambil jumlah jadwal periksa untuk dokter yang sedang login
        $jumlahJadwal = $this->getJumlahJadwal();

        // Mengambil jumlah pasien
        $jumlahPasien = $this->getJumlahPasien();

        // Mengambil jumlah pasien yang belum diperiksa (belum ada periksa yang terkait)
        $jumlahPasienBelumDiperiksa = $this->getJumlahPasienBelumDiperiksa();

        // Mengirimkan data statistik ke view 'dokter.dashboard'
        return view('dokter.dashboard', compact(
            'jumlahObat',
            'jumlahJadwal',
            'jumlahPasien',
            'jumlahPasienBelumDiperiksa'
        ));
    }

    /**
     * Mendapatkan jumlah obat yang terdaftar.
     *
     * @return int
     */
    private function getJumlahObat()
    {
        return Obat::count(); // Mengambil jumlah obat yang ada
    }

    /**
     * Mendapatkan jumlah jadwal periksa untuk dokter yang sedang login.
     *
     * @return int
     */
    private function getJumlahJadwal()
    {
        return JadwalPeriksa::where('id_dokter', Auth::id())->count(); // Jumlah jadwal periksa untuk dokter yang login
    }

    /**
     * Mendapatkan jumlah pasien yang terdaftar.
     *
     * @return int
     */
    private function getJumlahPasien()
    {
        return User::where('role', 'pasien')->count(); // Jumlah pasien
    }

    /**
     * Mendapatkan jumlah pasien yang belum diperiksa (tidak memiliki pemeriksaan terkait).
     *
     * @return int
     */
    private function getJumlahPasienBelumDiperiksa()
    {
        return JanjiPeriksa::whereDoesntHave('periksa')->count(); // Pasien yang memiliki janji periksa, namun belum ada pemeriksaan
    }
}
