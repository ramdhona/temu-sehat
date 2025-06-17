<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa; // Model untuk JadwalPeriksa
use App\Models\JanjiPeriksa; // Model untuk JanjiPeriksa
use App\Models\User; // Model untuk User (Pasien)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JanjiPeriksaController extends Controller
{
    /**
     * Menampilkan halaman daftar janji periksa pasien.
     *
     * Fungsi ini digunakan untuk menampilkan daftar dokter yang memiliki jadwal yang aktif
     * dan dapat dipilih oleh pasien untuk membuat janji periksa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil nomor rekam medis pasien yang sedang login
        $no_rm = Auth::user()->no_rm;

        // Mengambil data dokter dengan jadwal yang aktif
        $dokters = User::with([
            'jadwalPeriksas' => function ($query) {
                $query->where('status', true); // Menampilkan hanya jadwal yang aktif
            },
        ])
            ->where('role', 'dokter') // Menyaring hanya user dengan role 'dokter'
            ->get();

        // Mengirimkan data nomor rekam medis dan daftar dokter ke view
        return view('pasien.janji-periksa.index')->with([
            'no_rm' => $no_rm,
            'dokters' => $dokters,
        ]);
    }

    /**
     * Menyimpan data janji periksa pasien.
     *
     * Fungsi ini digunakan untuk menyimpan data janji periksa yang baru dibuat oleh pasien
     * dengan memilih dokter dan memberikan keluhan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi inputan dari form
        $request->validate([
            'id_dokter' => 'required|exists:users,id', // Pastikan id_dokter valid
            'keluhan' => 'required', // Keluhan harus diisi
        ]);

        // Mencari jadwal pemeriksaan yang aktif untuk dokter yang dipilih
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', $request->id_dokter)
            ->where('status', true) // Pastikan jadwal tersebut aktif
            ->first(); // Ambil jadwal pertama yang ditemukan

        // Menghitung jumlah janji periksa yang sudah ada untuk jadwal ini
        $jumlahJanji = JanjiPeriksa::where('id_jadwal_periksa', $jadwalPeriksa->id)->count();

        // Menghitung nomor antrian berdasarkan jumlah janji yang sudah ada
        $noAntrian = $jumlahJanji + 1;

        // Menyimpan data janji periksa ke dalam database
        JanjiPeriksa::create([
            'id_pasien' => Auth::user()->id, // ID pasien yang sedang login
            'id_jadwal_periksa' => $jadwalPeriksa->id, // ID jadwal yang dipilih
            'keluhan' => $request->keluhan, // Keluhan dari pasien
            'no_antrian' => $noAntrian, // Nomor antrian berdasarkan jumlah janji yang sudah ada
        ]);

        // Redirect ke halaman daftar janji periksa dengan pesan sukses
        return Redirect::route('pasien.janji-periksa.index')->with('status', 'janji-periksa-created');
    }
}
