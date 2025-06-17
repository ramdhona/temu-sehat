<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa; // Model untuk JanjiPeriksa
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan data pengguna yang sedang login

class RiwayatPeriksaController extends Controller
{
    /**
     * Menampilkan daftar riwayat periksa pasien.
     *
     * Fungsi ini akan mengambil data janji periksa berdasarkan ID pasien yang sedang login
     * dan mengirimkan data tersebut ke view untuk ditampilkan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan nomor rekam medis pasien yang sedang login
        $no_rm = Auth::user()->no_rm;

        // Mengambil daftar janji periksa pasien berdasarkan ID pasien yang sedang login
        $janjiPeriksas = JanjiPeriksa::where('id_pasien', Auth::user()->id)->get();

        // Mengirimkan data nomor rekam medis dan daftar janji periksa ke view
        return view('pasien.riwayat-periksa.index')->with([
            'no_rm' => $no_rm,
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }

    /**
     * Menampilkan detail riwayat pemeriksaan pasien berdasarkan ID janji periksa.
     *
     * Fungsi ini mengambil data janji periksa berdasarkan ID yang diterima sebagai parameter,
     * kemudian mengambil data jadwal periksa dan dokter yang terkait dengan janji tersebut.
     *
     * @param  int  $id  ID dari janji periksa yang ingin dilihat detailnya
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        // Mengambil data janji periksa berdasarkan ID yang diberikan, beserta relasi jadwal periksa dan dokter
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);

        // Mengirimkan data janji periksa ke view untuk ditampilkan
        return view('pasien.riwayat-periksa.detail')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

    /**
     * Menampilkan riwayat pemeriksaan pasien berdasarkan ID janji periksa.
     *
     * Fungsi ini mengambil data janji periksa dan riwayat pemeriksaan yang terkait dengan janji periksa tersebut.
     * Kemudian mengirimkan data riwayat periksa dan janji periksa ke view untuk ditampilkan.
     *
     * @param  int  $id  ID dari janji periksa yang riwayatnya ingin dilihat
     * @return \Illuminate\View\View
     */
    public function riwayat($id)
    {
        // Mengambil data janji periksa berdasarkan ID yang diberikan, beserta relasi jadwal periksa dan dokter
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);

        // Mengambil riwayat pemeriksaan yang terkait dengan janji periksa
        $riwayat = $janjiPeriksa->riwayatPeriksa;

        // Mengirimkan data riwayat periksa dan janji periksa ke view
        return view('pasien.riwayat-periksa.riwayat')->with([
            'riwayat' => $riwayat,
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }
}
