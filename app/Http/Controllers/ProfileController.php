<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan formulir profil pengguna untuk diedit.
     * Fungsi ini dipanggil ketika pengguna ingin mengubah data profil mereka.
     */
    public function edit(Request $request): View
    {
        // Mengembalikan tampilan profil untuk diedit dengan membawa data pengguna yang sedang login
        return view('profile.edit', [
            'user' => $request->user(),  // Mengambil data pengguna yang sedang login
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     * Fungsi ini dipanggil ketika pengguna mengirimkan perubahan profil mereka.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi data pengguna yang sudah divalidasi dengan data baru dari request
        $request->user()->fill([
            'nama' => $request->validated()['nama'],      // Mengupdate nama pengguna
            'email' => $request->validated()['email'],    // Mengupdate email pengguna
            'alamat' => $request->validated()['alamat'],  // Menambahkan atau mengupdate alamat
            'no_hp' => $request->validated()['no_hp'],    // Menambahkan atau mengupdate nomor HP
            'no_ktp' => $request->validated()['no_ktp'],  // Menambahkan atau mengupdate nomor KTP
            'poli' => $request->validated()['poli'],      // Menambahkan atau mengupdate poli
        ]);

        // Mengecek apakah ada perubahan pada kolom email, jika ada maka mengosongkan kolom email_verified_at
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;  // Mengosongkan waktu verifikasi email
        }

        // Menyimpan perubahan yang telah dilakukan pada data pengguna
        $request->user()->save();

        // Mengarahkan kembali ke halaman profil edit dan memberikan pesan status bahwa profil telah diperbarui
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna.
     * Fungsi ini dipanggil ketika pengguna ingin menghapus akun mereka secara permanen.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi bahwa pengguna telah mengisi password yang benar sebelum menghapus akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],  // Memastikan password yang dimasukkan adalah password yang benar
        ]);

        // Mengambil data pengguna yang sedang login
        $user = $request->user();

        // Logout pengguna secara otomatis setelah menghapus akun
        Auth::logout();

        // Menghapus data pengguna dari database
        $user->delete();

        // Menghancurkan session dan menghasilkan token baru untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman utama setelah akun dihapus
        return Redirect::to('/');
    }
}
