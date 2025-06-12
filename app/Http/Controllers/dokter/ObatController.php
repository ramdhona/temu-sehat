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
        $obats = Obat::all();
        return view('dokter.obat.index')->with([
            'obats' => $obats,
        ]);
    }

    // Menampilkan form untuk menambah obat baru
    public function create()
    {
        return view('dokter.obat.create');
    }

    // Menyimpan data obat baru
    public function store(Request $request)
    {
        // Validasi inputan yang diterima dari form
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        // Membuat entri obat baru di database
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        // Redirect dengan flash message
        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil tersimpan');
    }

    // Menyimpan pembaruan data obat
    public function update(Request $request, $id)
    {
        // Validasi inputan yang diterima dari form
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        // Mencari obat berdasarkan ID yang diberikan
        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        // Redirect dengan flash message
        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menampilkan form untuk mengedit data obat berdasarkan ID
    public function edit($id)
    {
        // Mencari obat berdasarkan ID
        $obat = Obat::find($id);

        // Jika obat tidak ditemukan, redirect atau berikan error
        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan');
        }

        // Mengembalikan view 'dokter.obat.edit' dan mengirimkan data obat yang ditemukan
        return view('dokter.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    // Menghapus data obat berdasarkan ID
    public function destroy($id)
    {
        $obat = Obat::find($id);
        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan');
        }
        $obat->delete();

        // Redirect dengan flash message
        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil dihapus');
    }
}
