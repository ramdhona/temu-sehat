<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class JadwalPeriksaController extends Controller
{
    /**
     * Menampilkan halaman untuk membuat jadwal pemeriksaan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dokter.jadwal.create'); // Mengarahkan ke halaman form pembuatan jadwal
    }

    /**
     * Menyimpan jadwal pemeriksaan yang baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'hari' => 'required|string', // Pastikan hari dipilih
            'jam_mulai' => 'required|date_format:H:i', // Validasi format waktu mulai
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Validasi format waktu selesai dan setelah waktu mulai
        ]);

        // Cek apakah jadwal dengan waktu dan hari yang sama sudah ada
        $existingSchedule = JadwalPeriksa::where('id_dokter', Auth::id())  // Hanya jadwal untuk dokter yang sedang login
            ->where('hari', $request->hari)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('jam_selesai', $request->jam_selesai)
            ->exists(); // Mengecek apakah jadwal sudah ada

        // Jika jadwal sudah ada, tampilkan error dengan SweetAlert2
        if ($existingSchedule) {
            return redirect()->back()->with('error', 'Jadwal tidak boleh sama dengan jadwal yang sudah tersedia');
        }

        // Simpan jadwal baru ke dalam database
        JadwalPeriksa::create([
            'id_dokter' => Auth::id(), // ID dokter yang sedang login
            'hari' => $request->hari, // Hari untuk jadwal
            'jam_mulai' => $request->jam_mulai, // Jam mulai jadwal
            'jam_selesai' => $request->jam_selesai, // Jam selesai jadwal
            'status' => 0,  // Status default 'nonaktif'
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Menampilkan daftar jadwal pemeriksaan yang dimiliki oleh dokter yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua jadwal yang dimiliki oleh dokter yang sedang login
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())->get(); 

        // Mengarahkan ke halaman daftar jadwal dan mengirimkan data jadwal
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    /**
     * Mengubah status jadwal antara aktif dan nonaktif.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus($id)
    {
        // Mencari jadwal berdasarkan ID
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Jika status jadwal bukan aktif (1), aktifkan jadwal ini
        if ($jadwal->status !== 1) {
            // Nonaktifkan semua jadwal yang aktif untuk dokter yang sama
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('status', 1)
                ->update(['status' => 0]); // Set status jadwal lain menjadi nonaktif

            // Aktifkan jadwal yang dipilih
            $jadwal->status = 1;
        } else {
            // Jika jadwal sudah aktif, set status menjadi nonaktif
            $jadwal->status = 0;
        }

        // Simpan perubahan status jadwal
        $jadwal->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status jadwal berhasil diubah.');
    }

    /**
     * Menghapus jadwal berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Mencari jadwal berdasarkan ID
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Menghapus jadwal dari database
        $jadwal->delete();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
