<?php
namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Menampilkan daftar semua obat yang ada.
     *
     * Fungsi ini akan mengambil semua data obat dari database (termasuk yang telah dihapus secara soft delete),
     * dan kemudian menampilkannya di halaman view 'dokter.obat.index'.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $obats = Obat::all(); // Menampilkan semua obat (termasuk yang tidak dihapus)
        return view('dokter.obat.index', compact('obats')); // Mengirim data obat ke view
    }

    /**
     * Menampilkan form untuk menambah obat baru.
     *
     * Fungsi ini digunakan untuk menampilkan halaman form yang digunakan
     * oleh pengguna untuk menambahkan data obat baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengembalikan view untuk form tambah obat
        return view('dokter.obat.create');
    }

    /**
     * Menampilkan halaman untuk obat yang dihapus.
     *
     * Fungsi ini akan menampilkan obat-obat yang telah dihapus menggunakan soft delete,
     * sehingga pengguna dapat melihat data yang sudah dihapus.
     *
     * @return \Illuminate\View\View
     */
    public function deleted()
    {
        $obats = Obat::onlyTrashed()->get(); // Menampilkan obat yang dihapus (soft delete)
        return view('dokter.obat.deleted', compact('obats')); // Mengirim data obat yang dihapus ke view
    }

    /**
     * Menyimpan data obat baru ke dalam database.
     *
     * Fungsi ini bertanggung jawab untuk menyimpan data obat baru ke dalam database setelah validasi data
     * dilakukan untuk memastikan data yang dimasukkan sesuai dengan format yang diinginkan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_obat' => 'required|string|max:255', // Nama obat harus diisi dan berupa string
            'kemasan' => 'required|string|max:255',  // Kemasan obat harus diisi dan berupa string
            'harga' => 'required|numeric|min:0',     // Harga harus berupa angka dan lebih besar dari 0
        ]);

        // Menyimpan data obat baru
        Obat::create([ 
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        // Redirect ke halaman daftar obat dengan status berhasil
        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil tersimpan');
    }

    /**
     * Mengembalikan data obat yang dihapus.
     *
     * Fungsi ini bertugas untuk mengembalikan (restore) data obat yang telah dihapus menggunakan soft delete.
     * Data yang dihapus hanya dipulihkan kembali tanpa mengubah status penghapusan permanen.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $obat = Obat::withTrashed()->find($id); // Mencari obat yang sudah dihapus

        if (!$obat) {
            return redirect()->route('dokter.obat.deleted')->with('error', 'Obat tidak ditemukan');
        }

        // Restore obat yang dihapus
        $obat->restore();

        // Redirect ke halaman obat yang dihapus dengan status berhasil
        return redirect()->route('dokter.obat.deleted')->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Menghapus data obat secara permanen.
     *
     * Fungsi ini akan menghapus data obat secara permanen (force delete), 
     * tanpa bisa dipulihkan kembali menggunakan soft delete.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function permanentDelete($id)
    {
        $obat = Obat::withTrashed()->find($id); // Mencari obat yang sudah dihapus

        if (!$obat) {
            return redirect()->route('dokter.obat.deleted')->with('error', 'Obat tidak ditemukan');
        }

        // Menghapus secara permanen
        $obat->forceDelete();

        // Redirect ke halaman obat yang dihapus dengan status berhasil
        return redirect()->route('dokter.obat.deleted')->with('success', 'Data berhasil dihapus permanen');
    }

    /**
     * Menampilkan form untuk mengedit data obat berdasarkan ID.
     *
     * Fungsi ini digunakan untuk menampilkan halaman form edit obat berdasarkan ID yang dipilih.
     * Jika obat tidak ditemukan, pengguna akan diarahkan ke halaman daftar obat.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $obat = Obat::find($id); // Mencari obat berdasarkan ID

        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan');
        }

        // Mengirim data obat yang ditemukan ke view edit
        return view('dokter.obat.edit', compact('obat'));
    }

    /**
     * Menyimpan pembaruan data obat.
     *
     * Fungsi ini digunakan untuk memperbarui data obat yang sudah ada.
     * Sebelum diperbarui, data terlebih dahulu divalidasi.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_obat' => 'required|string|max:255', // Nama obat harus diisi dan berupa string
            'kemasan' => 'required|string|max:255',  // Kemasan obat harus diisi dan berupa string
            'harga' => 'required|numeric|min:0',     // Harga harus berupa angka dan lebih besar dari 0
        ]);

        $obat = Obat::find($id); // Mencari obat berdasarkan ID

        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan');
        }

        // Memperbarui data obat
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        // Redirect ke halaman daftar obat dengan status berhasil
        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Menghapus data obat berdasarkan ID (Soft Delete).
     *
     * Fungsi ini melakukan penghapusan data obat dengan menggunakan soft delete,
     * yang berarti data akan tetap ada di database namun ditandai sebagai "dihapus".
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $obat = Obat::find($id); // Mencari obat berdasarkan ID

        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan');
        }

        $obat->delete(); // Soft delete

        // Redirect ke halaman daftar obat dengan status berhasil
        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil dihapus');
    }
}
