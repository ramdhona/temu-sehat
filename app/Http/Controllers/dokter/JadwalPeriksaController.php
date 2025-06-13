<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class JadwalPeriksaController extends Controller
{
    // Menampilkan halaman untuk membuat jadwal
    public function create()
    {
        return view('dokter.jadwal.create');
    }

    // Menyimpan jadwal pemeriksaan
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek apakah jadwal yang sama sudah ada
        $existingSchedule = JadwalPeriksa::where('id_dokter', Auth::id())
            ->where('hari', $request->hari)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('jam_selesai', $request->jam_selesai)
            ->exists();

        // Jika jadwal yang sama sudah ada, tampilkan error dengan SweetAlert2
        if ($existingSchedule) {
            return redirect()->back()->with('error', 'Jadwal tidak boleh sama dengan jadwal yang sudah tersedia');
        }

        // Simpan jadwal baru
        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 0,  // Status nonaktif sebagai default
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan daftar jadwal pemeriksaan
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())->get();
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    // Mengubah status jadwal
    public function toggleStatus($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        if ($jadwal->status !== 1) {
            // Nonaktifkan jadwal aktif lainnya
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('status', 1)
                ->update(['status' => 0]);

            // Aktifkan jadwal ini
            $jadwal->status = 1;
        } else {
            // Jika aktif, set menjadi nonaktif
            $jadwal->status = 0;
        }

        $jadwal->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status jadwal berhasil diubah.');
    }

    // Menghapus jadwal
    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->delete();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
