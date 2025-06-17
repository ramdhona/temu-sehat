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
    /**
     * Menampilkan daftar periksa pasien untuk dokter yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan ID dokter yang sedang login
        $id_dokter = Auth::user()->id;

        // Mengambil data pasien yang terhubung dengan jadwal periksa aktif untuk dokter yang sedang login
        $pasien = JanjiPeriksa::with('pasien', 'jadwalPeriksa') // Relasi dengan pasien dan jadwal periksa
            ->whereHas('jadwalPeriksa', function ($query) use ($id_dokter) {
                $query->where('id_dokter', $id_dokter) // Cek ID dokter
                    ->where('status', 1); // Cek jadwal yang statusnya aktif (1)
            })
            ->get();

        // Mengembalikan view dengan data pasien
        return view('dokter.memeriksa.index', compact('pasien'));
    }

    /**
     * Menampilkan halaman untuk pemeriksaan pasien.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function periksa($id)
    {
        // Mengambil data janji periksa berdasarkan ID
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        // Mengambil semua data obat untuk pilihan obat
        $obats = Obat::all();

        // Mengembalikan view untuk pemeriksaan dengan data janji periksa dan obat yang tersedia
        return view('dokter.memeriksa.periksa', compact('janjiPeriksa', 'obats'));
    }

    /**
     * Menyimpan hasil pemeriksaan pasien.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function simpanPeriksa(Request $request, $id)
    {
        // Mencari janji periksa berdasarkan ID
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        // Validasi form input pemeriksaan
        $request->validate([
            'catatan' => 'required', // Catatan wajib diisi
            'obat' => 'present|array' // Obat harus ada, meski kosong
        ]);

        // Menghitung total harga obat yang dipilih
        $hargaObat = 0;
        if ($request->has('obat')) {
            // Mengambil harga total dari semua obat yang dipilih
            $hargaObat = Obat::whereIn('id', $request->obat)->sum('harga');
        }

        // Menyimpan data pemeriksaan
        $periksa = Periksa::create([
            'id_janji_periksa' => $janjiPeriksa->id,
            'tgl_periksa' => now(),
            'catatan' => $request->catatan,
            'biaya_periksa' => 150000 + $hargaObat, // Biaya periksa ditambah harga obat
        ]);

        // Menyimpan detail obat yang dipilih
        if ($request->has('obat')) {
            foreach ($request->obat as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }
        }

        // Redirect ke halaman daftar pemeriksaan dengan pesan sukses
        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
    }

    /**
     * Menampilkan halaman edit pemeriksaan pasien.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Mengambil data janji periksa dan obat yang dipilih
        $janjiPeriksa = JanjiPeriksa::with('pasien', 'obats')->findOrFail($id); // Relasi dengan obat yang dipilih
        $obats = Obat::all(); // Mengambil semua data obat

        // Mengembalikan view untuk edit pemeriksaan
        return view('dokter.memeriksa.edit', compact('janjiPeriksa', 'obats'));
    }

    /**
     * Menyimpan hasil edit pemeriksaan pasien.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Mencari janji periksa berdasarkan ID
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        // Validasi form input untuk edit pemeriksaan
        $request->validate([
            'catatan' => 'required|string',
            'obat' => 'present|array', // Obat harus ada, meskipun kosong
            'obat.*' => 'exists:obats,id', // Pastikan setiap obat valid
        ]);

        // Menghitung total harga obat yang dipilih
        $hargaObat = 0;
        if ($request->has('obat')) {
            // Mengambil total harga dari semua obat yang dipilih
            $hargaObat = Obat::whereIn('id', $request->obat)->sum('harga');
        }

        // Mengupdate data pemeriksaan
        $periksa = $janjiPeriksa->periksa; // Ambil pemeriksaan yang sudah ada
        $periksa->catatan = $request->catatan;
        $periksa->biaya_periksa = 150000 + $hargaObat; // Total biaya periksa ditambah harga obat
        $periksa->save(); // Simpan perubahan

        // Mengupdate detail obat yang dipilih
        if ($request->has('obat')) {
            $periksa->obats()->sync($request->obat); // Mengupdate hubungan antara pemeriksaan dan obat yang dipilih
        }

        // Redirect ke halaman daftar pemeriksaan dengan pesan sukses
        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui!');
    }
}
