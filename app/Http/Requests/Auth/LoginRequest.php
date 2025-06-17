<?php
namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Fungsi ini digunakan untuk memeriksa apakah pengguna memiliki izin untuk melakukan permintaan ini.
     * Dalam kasus ini, selalu mengembalikan `true`, yang berarti semua pengguna dapat membuat permintaan login.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Fungsi ini menetapkan aturan validasi untuk permintaan login.
     * Di sini, kita memastikan bahwa `email` dan `password` wajib diisi dan bahwa `email` adalah format yang benar.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],  // Validasi email harus ada, bertipe string, dan format email yang valid
            'password' => ['required', 'string'],        // Validasi password harus ada dan bertipe string
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * Fungsi ini mencoba untuk memverifikasi kredensial pengguna menggunakan metode `Auth::attempt`.
     * Jika kredensial salah, maka percakapan login akan dihentikan dan proses rate limiting dimulai.
     * Jika login berhasil, kunci rate limiting akan dihapus.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // Memeriksa apakah jumlah percobaan login telah mencapai batas
        $this->ensureIsNotRateLimited();

        // Mencoba melakukan autentikasi dengan menggunakan email dan password yang diberikan
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // Jika login gagal, hitung upaya login yang gagal dan lempar pengecualian
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),  // Pesan gagal login
            ]);
        }

        // Jika login berhasil, hapus rate limiter untuk login
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * Fungsi ini memastikan bahwa percakapan login tidak dibatasi oleh rate limiting.
     * Jika jumlah percakapan login gagal melebihi batas yang diizinkan (5 percakapan), 
     * maka fungsi ini akan mengaktifkan event `Lockout` dan melempar pengecualian yang menunjukkan
     * waktu tunggu untuk login berikutnya.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        // Cek apakah jumlah percakapan login gagal sudah melebihi batas
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;  // Jika belum melebihi batas, lanjutkan ke proses login
        }

        // Menyimpan event lockout jika sudah terlalu banyak percakapan login gagal
        event(new Lockout($this));

        // Mengambil sisa waktu tunggu hingga login berikutnya diizinkan
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Lempar pengecualian dengan pesan waktu tunggu yang tersedia
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,   // Sisa detik hingga bisa login lagi
                'minutes' => ceil($seconds / 60), // Waktu dalam menit hingga bisa login lagi
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * Fungsi ini menghasilkan kunci unik untuk rate limiting berdasarkan kombinasi email pengguna dan alamat IP mereka.
     * Kunci ini digunakan untuk memantau jumlah percakapan login yang gagal dari alamat email dan IP tertentu.
     *
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip()); 
        // Membuat kunci unik dengan menggabungkan email (dalam format kecil) dan alamat IP
    }
}
