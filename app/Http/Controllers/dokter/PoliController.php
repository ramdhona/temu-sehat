<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Menampilkan daftar semua poli.
     *
     * Fungsi ini bertugas untuk mengambil seluruh data poli dari database
     * dan menampilkan data tersebut di halaman view 'dokter.poli.index'.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $polis = Poli::all(); // Mendapatkan semua data poli
        return view('dokter.poli.index', compact('polis')); // Mengirim data poli ke view
    }

    /**
     * Menampilkan form untuk menambah poli baru.
     *
     * Fungsi ini digunakan untuk menampilkan halaman form yang digunakan
     * oleh pengguna untuk memasukkan data poli baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dokter.poli.create'); // Menampilkan form untuk membuat poli baru
    }

    /**
     * Menyimpan poli baru.
     *
     * Fungsi ini digunakan untuk menyimpan data poli baru yang dikirimkan
     * dari form ke dalam database. Data yang diterima divalidasi terlebih
     * dahulu untuk memastikan bahwa input dari pengguna valid.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_poli' => 'required|string|max:255', // Validasi bahwa 'nama_poli' harus ada, berupa string dan maksimal 255 karakter
        ]);

        // Menyimpan poli baru
        Poli::create($request->all()); // Menyimpan semua data dari request ke dalam tabel poli

        // Redirect ke halaman index poli dengan status berhasil
        return redirect()->route('dokter.poli.index')->with('success', 'Poli berhasil ditambahkan'); // Redirect dengan pesan sukses
    }

    /**
     * Menampilkan form untuk mengedit poli.
     *
     * Fungsi ini digunakan untuk menampilkan form edit untuk poli tertentu
     * berdasarkan parameter poli yang dipilih. Data poli akan dikirim
     * ke form edit agar dapat diperbarui.
     *
     * @param \App\Models\Poli $poli
     * @return \Illuminate\View\View
     */
    public function edit(Poli $poli)
    {
        return view('dokter.poli.edit', compact('poli')); // Menampilkan form edit dengan membawa data poli yang akan diubah
    }

    /**
     * Memperbarui data poli.
     *
     * Fungsi ini bertugas untuk memperbarui data poli yang sudah ada.
     * Sama seperti saat menyimpan data baru, data yang dikirimkan akan
     * divalidasi terlebih dahulu.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Poli $poli
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Poli $poli)
    {
        // Validasi input
        $request->validate([
            'nama_poli' => 'required|string|max:255', // Validasi data yang akan diupdate
        ]);

        // Memperbarui poli
        $poli->update($request->all()); // Update data poli yang ada berdasarkan request

        // Redirect ke halaman index poli dengan status berhasil
        return redirect()->route('dokter.poli.index')->with('success', 'Poli berhasil diperbarui'); // Redirect dengan pesan sukses
    }

    /**
     * Menghapus poli.
     *
     * Fungsi ini digunakan untuk menghapus data poli tertentu berdasarkan
     * ID yang dipilih. Setelah penghapusan berhasil, halaman akan diarahkan
     * kembali ke halaman daftar poli dengan pesan sukses.
     *
     * @param \App\Models\Poli $poli
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Poli $poli)
    {
        // Menghapus poli
        $poli->delete(); // Menghapus data poli dari database

        // Redirect ke halaman index poli dengan status berhasil
        return redirect()->route('dokter.poli.index')->with('success', 'Poli berhasil dihapus'); // Redirect dengan pesan sukses
    }
}
