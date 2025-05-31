<?php

namespace App\Http\Controllers\dokter;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // Menampilkan daftar obat
    public function index()
    {
        // Mengambil semua data obat dari database
        $obats = Obat::all();

        // Mengembalikan view 'dokter.obat.index' dan mengirimkan data obat ke view
        return view('dokter.obat.index')->with([
            'obats' => $obats,
        ]);
    }

    // Menampilkan form untuk menambah obat baru
    public function create(){
        // Mengembalikan view 'dokter.obat.create' untuk form tambah obat
        return view('dokter.obat.create');
    }

    // Menampilkan form untuk mengedit data obat berdasarkan ID
    public function edit($id)
    {
        // Mencari obat berdasarkan ID
        $obat = Obat::find($id);

        // Mengembalikan view 'dokter.obat.edit' dan mengirimkan data obat yang ditemukan
        return view('dokter.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    // Menyimpan data obat baru ke dalam database
    public function store(Request $request)
    {
        // Validasi inputan yang diterima dari form
        $request->validate([
            'nama_obat' => 'required|string|max:255', // Nama obat harus ada, string, maksimal 255 karakter
            'kemasan' => 'required|string|max:255', // Kemasan harus ada, string, maksimal 255 karakter
            'harga' => 'required|numeric|min:0', // Harga harus ada, angka, minimal 0
        ]);

        // Membuat entri obat baru di database
        Obat::create([
            'nama_obat' => $request->nama_obat, // Menyimpan nama obat
            'kemasan' => $request->kemasan, // Menyimpan kemasan obat
            'harga' => $request->harga, // Menyimpan harga obat
        ]);

        // Mengarahkan kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    // Memperbarui data obat yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi inputan yang diterima dari form
        $request->validate([
            'nama_obat' => 'required|string|max:255', // Nama obat harus ada, string, maksimal 255 karakter
            'kemasan' => 'required|string|max:255', // Kemasan harus ada, string, maksimal 255 karakter
            'harga' => 'required|numeric|min:0', // Harga harus ada, angka, minimal 0
        ]);

        // Mencari obat berdasarkan ID yang diberikan
        $obat = Obat::find($id);

        // Memperbarui data obat dengan data yang diterima dari form
        $obat->update([
            'nama_obat' => $request->nama_obat, // Memperbarui nama obat
            'kemasan' => $request->kemasan, // Memperbarui kemasan obat
            'harga' => $request->harga, // Memperbarui harga obat
        ]);

        // Mengarahkan kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    // Menghapus data obat berdasarkan ID
    public function destroy($id)
    {
        // Mencari obat berdasarkan ID
        $obat = Obat::find($id);

        // Menghapus data obat dari database
        $obat->delete();

        // Mengarahkan kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
