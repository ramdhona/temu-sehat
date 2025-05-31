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
        // Mengembalikan view untuk membuat jadwal pemeriksaan
        return view('dokter.jadwal.create');
    }

    // Menyimpan jadwal pemeriksaan
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'hari' => 'required|string', // Hari harus diisi dan berupa string
            'jam_mulai' => 'required|date_format:H:i', // Jam mulai harus diisi dan sesuai format waktu
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Jam selesai harus diisi, sesuai format waktu, dan setelah jam mulai
        ]);

        // Cek apakah dokter sudah memiliki jadwal yang sama
        $existingSchedule = JadwalPeriksa::where('id_dokter', Auth::id())
            ->where('hari', $request->hari)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('jam_selesai', $request->jam_selesai)
            ->exists();

        // Jika jadwal yang sama sudah ada, lemparkan exception dengan pesan error
        if ($existingSchedule) {
            throw ValidationException::withMessages([
                'hari' => 'Jadwal yang sama sudah ada.',
            ]);
        }

        // Simpan jadwal baru ke dalam database
        JadwalPeriksa::create([
            'id_dokter' => Auth::id(), // ID dokter yang sedang login
            'hari' => $request->hari, // Hari jadwal
            'jam_mulai' => $request->jam_mulai, // Jam mulai jadwal
            'jam_selesai' => $request->jam_selesai, // Jam selesai jadwal
            'status' => 'nonaktif',  // Set status default jadwal menjadi nonaktif
        ]);

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan daftar jadwal pemeriksaan
    public function index()
    {
        // Mengambil semua jadwal pemeriksaan untuk dokter yang sedang login
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())->get();

        // Mengembalikan view dengan daftar jadwal
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    // Mengubah status jadwal
    public function toggleStatus($id)
    {
        // Mencari jadwal berdasarkan ID
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Jika jadwal saat ini tidak aktif, aktifkan jadwal ini
        if ($jadwal->status !== 'aktif') {
            //Nonaktifkan jadwal aktif lain untuk dokter yang sama
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('status', 'aktif')
                ->update(['status' => 'nonaktif']);

            // Aktifkan jadwal ini
            $jadwal->status = 'aktif';
        } else {
            // Jika jadwal saat ini aktif, jadikan nonaktif
            $jadwal->status = 'nonaktif';
        }

        // Simpan perubahan status jadwal
        $jadwal->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Status jadwal berhasil diubah.');
    }

    // Menghapus jadwal
    public function destroy($id)
    {
        // Mencari jadwal berdasarkan ID
        $jadwal = JadwalPeriksa::findOrFail($id);
        // Menghapus jadwal dari database
        $jadwal->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
