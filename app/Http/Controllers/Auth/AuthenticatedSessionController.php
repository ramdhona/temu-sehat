<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan tampilan login.
     * Fungsi ini dipanggil untuk menampilkan halaman login kepada pengguna.
     * Biasanya diakses saat pengguna mengunjungi halaman login.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login'); // Mengembalikan tampilan login yang ada di file 'auth.login'
    }

    /**
     * Menangani permintaan otentikasi yang masuk.
     * Fungsi ini memvalidasi dan memverifikasi kredensial pengguna yang dikirimkan melalui formulir login.
     * Setelah otentikasi berhasil, sesi pengguna akan diperbarui dan pengguna akan diarahkan ke halaman yang sesuai dengan peran mereka.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
   public function store(LoginRequest $request): RedirectResponse
    {
        // Melakukan otentikasi pengguna dengan kredensial yang diberikan di request
        $request->authenticate();

        // Memperbarui sesi pengguna setelah otentikasi berhasil
        $request->session()->regenerate();

        // Mendapatkan pengguna yang baru saja login
        $user = Auth::user();

        // Mengarahkan pengguna ke halaman yang sesuai berdasarkan peran mereka
        if ($user->role == 'dokter') {
            // Jika pengguna adalah dokter, arahkan ke dashboard dokter
            return redirect()->intended(route('dokter.dashboard'));
        } elseif ($user->role == 'pasien') {
            // Jika pengguna adalah pasien, arahkan ke dashboard pasien
            return redirect()->intended(route('pasien.dashboard'));
        }
    }

    /**
     * Menghancurkan sesi yang sudah terautentikasi.
     * Fungsi ini digunakan untuk logout pengguna dan menghapus sesi mereka.
     * Setelah logout, sesi pengguna akan dihapus dan token sesi akan diperbarui untuk keamanan.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Melakukan logout pada pengguna yang terautentikasi
        Auth::guard('web')->logout();

        // Menghapus sesi pengguna
        $request->session()->invalidate();

        // Menghasilkan token sesi baru untuk mencegah serangan CSRF
        $request->session()->regenerateToken();

        // Mengarahkan pengguna kembali ke halaman utama setelah logout
        return redirect('/'); // Pengguna akan diarahkan ke halaman beranda setelah logout
    }
}
