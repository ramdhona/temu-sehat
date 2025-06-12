<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User; // Model Pasien
use App\Models\Periksa; // Model Pemeriksaan

class RiwayatController extends Controller
{
    // Method untuk menampilkan daftar riwayat pemeriksaan (index)
    public function index()
{
    // Ambil data pasien yang memiliki role 'pasien'
    $pasien = User::where('role', 'pasien')->get();

    // Ambil riwayat pemeriksaan (jika dibutuhkan)
    $riwayat = Periksa::all(); // Sesuaikan dengan kebutuhanmu

    // Kirim data pasien dan riwayat ke view
    return view('dokter.riwayat.index', compact('riwayat', 'pasien'));
}



    // Method untuk menampilkan riwayat pemeriksaan pasien berdasarkan ID
    public function show($id)
    {
        $pasien = User::findOrFail($id);
        $riwayat = Periksa::whereHas('janjiPeriksa', function ($query) use ($id) {
            $query->where('id_pasien', $id);
        })->get();

        return view('dokter.riwayat.show', compact('pasien', 'riwayat'));
    }
}

