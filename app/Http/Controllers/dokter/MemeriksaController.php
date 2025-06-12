<?php

namespace App\Http\Controllers\Dokter;

use App\Models\JanjiPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemeriksaController extends Controller
{
    // Menampilkan daftar periksa pasien untuk dokter yang sedang login
    public function index()
    {
        $id_dokter = Auth::user()->id; // Mendapatkan ID dokter yang sedang login
        $pasien = JanjiPeriksa::with('pasien', 'jadwalPeriksa') // Relasi dengan pasien dan jadwal periksa
            ->whereHas('jadwalPeriksa', function ($query) use ($id_dokter) {
                $query->where('id_dokter', $id_dokter) // Cek ID dokter
                    ->where('status', 1); // Cek jadwal yang statusnya aktif (1)
            })
            ->get();

        return view('dokter.memeriksa.index', compact('pasien'));
    }

    // Menampilkan halaman periksa pasien
    public function periksa($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $obats = Obat::all(); // Ambil semua obat untuk pilihan obat
        return view('dokter.memeriksa.periksa', compact('janjiPeriksa', 'obats'));
    }

    // Menyimpan hasil pemeriksaan
    public function simpanPeriksa(Request $request, $id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        // Validasi agar 'obat' selalu ada dan berupa array
        $request->validate([
            'catatan' => 'required',
            'obat' => 'present|array' // 'present' memastikan key 'obat' ada, meski kosong
        ]);

        $hargaObat = 0;
        if ($request->has('obat')) {
            // Ambil harga total dari semua obat yang dipilih
            $hargaObat = Obat::whereIn('id', $request->obat)->sum('harga');
        }

        // Menyimpan data pemeriksaan
        $periksa = Periksa::create([
            'id_janji_periksa' => $janjiPeriksa->id,
            'tgl_periksa' => now(),
            'catatan' => $request->catatan,
            // Biaya periksa (asumsi 150000) ditambah harga total obat
            'biaya_periksa' => 150000 + $hargaObat,
        ]);

        // Menyimpan detail obat yang dipilih selama pemeriksaan
        if ($request->has('obat')) {
            foreach ($request->obat as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }
        }

        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
    }

    // Menampilkan halaman edit pemeriksaan pasien
    public function edit($id)
    {
        // Ambil data janji periksa berdasarkan ID
        $janjiPeriksa = JanjiPeriksa::with('pasien', 'obats')->findOrFail($id); // Menambahkan relasi ke obat yang dipilih
        $obats = Obat::all(); // Ambil semua obat untuk pilihan obat

        return view('dokter.memeriksa.edit', compact('janjiPeriksa', 'obats'));
    }

    // Menyimpan hasil edit pemeriksaan
    public function update(Request $request, $id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        // Validasi data dari formulir
        $request->validate([
            'catatan' => 'required|string',
            'obat' => 'present|array', // Validasi obat yang dipilih
            'obat.*' => 'exists:obats,id', // Pastikan setiap obat valid
        ]);

        // Menghitung total harga obat yang dipilih
        $hargaObat = 0;
        if ($request->has('obat')) {
            $hargaObat = Obat::whereIn('id', $request->obat)->sum('harga');
        }

        // Update data pemeriksaan
        $periksa = $janjiPeriksa->periksa; // Ambil pemeriksaan yang sudah ada
        $periksa->catatan = $request->catatan;
        $periksa->biaya_periksa = 150000 + $hargaObat; // Biaya pemeriksaan ditambah dengan harga obat
        $periksa->save();

        // Mengupdate detail obat yang dipilih
        if ($request->has('obat')) {
            // Hapus detail obat sebelumnya
            $periksa->obats()->sync($request->obat); // Update detail obat
        }

        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui!');
    }
}
