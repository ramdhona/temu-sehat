<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Poli; // Mengimpor model Poli
use Illuminate\Http\Request; // Impor yang benar

class ProfileController extends Controller
{
    /**
     * Menampilkan formulir profil pengguna untuk diedit.
     *
     * Fungsi ini akan mengembalikan halaman edit profil pengguna yang sedang login.
     * Selain data pengguna yang sedang login, juga akan diambil daftar poli dari
     * database untuk ditampilkan dalam dropdown list pada form.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        // Mengambil semua data poli untuk ditampilkan dalam dropdown
        $polis = Poli::all();

        // Mengembalikan tampilan profil untuk diedit dengan membawa data pengguna yang sedang login
        return view('profile.edit', [
            'user' => $request->user(), // Mengirimkan data pengguna yang sedang login
            'polis' => $polis, // Mengirimkan data poli untuk dropdown
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     *
     * Fungsi ini bertugas untuk memperbarui data profil pengguna yang sedang login.
     * Data yang diperbarui divalidasi menggunakan `ProfileUpdateRequest`, kemudian disimpan
     * ke dalam database. Apabila ada perubahan pada kolom email, status verifikasi email akan
     * di-reset.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mendapatkan data pengguna yang sedang login
        $user = $request->user();

        // Mengisi data pengguna yang sudah divalidasi dengan data baru dari request
        $user->fill([
            'nama' => $request->validated()['nama'],  // Memperbarui nama
            'email' => $request->validated()['email'], // Memperbarui email
            'alamat' => $request->validated()['alamat'], // Memperbarui alamat
            'no_hp' => $request->validated()['no_hp'],  // Memperbarui nomor HP
            'no_ktp' => $request->validated()['no_ktp'], // Memperbarui nomor KTP
            'poli_id' => $request->validated()['poli_id'], // Memperbarui poli_id
        ]);

        // Mengecek apakah ada perubahan pada kolom email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null; // Mengatur ulang verifikasi email jika email berubah
        }

        // Menyimpan perubahan yang telah dilakukan
        $user->save();

        // Mengarahkan kembali ke halaman profil edit dengan status berhasil
        return Redirect::route('profile.edit')->with('status', 'profile-updated'); // Mengarahkan kembali dengan pesan sukses
    }

    /**
     * Menghapus akun pengguna.
     *
     * Fungsi ini akan menghapus akun pengguna yang sedang login setelah memvalidasi bahwa password yang dimasukkan
     * adalah password yang benar. Setelah akun dihapus, pengguna akan keluar dari sistem dan sesi akan dihancurkan.
     * Pengguna kemudian diarahkan ke halaman utama.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi bahwa pengguna telah mengisi password yang benar sebelum menghapus akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Memastikan password yang dimasukkan adalah password yang benar
        ]);

        $user = $request->user();  // Mendapatkan data pengguna yang sedang login
        Auth::logout();  // Mengeluarkan pengguna dari sesi saat ini
        $user->delete();  // Menghapus data pengguna dari database

        // Menghapus sesi pengguna dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman utama setelah penghapusan akun
        return Redirect::to('/');  // Redirect ke halaman utama setelah akun dihapus
    }
}
