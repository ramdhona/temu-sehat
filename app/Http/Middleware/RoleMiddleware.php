<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Pastikan ini ada untuk autentikasi pengguna
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Fungsi ini digunakan untuk memeriksa apakah pengguna yang sedang login memiliki peran (role)
     * yang sesuai dengan yang dibutuhkan sebelum melanjutkan permintaan (request).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  Role yang diperlukan untuk mengakses route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Mendapatkan informasi pengguna yang sedang login menggunakan Auth
        $user = Auth::user();

        // Memeriksa apakah peran pengguna yang sedang login tidak sesuai dengan peran yang dibutuhkan
        if ($user->role !== $role) {
            // Jika tidak sesuai, mengembalikan respons 'Unauthorized' dengan status kode 403
            return response('Unauthorized', 403);
        }

        // Jika peran sesuai, lanjutkan ke request berikutnya
        return $next($request);
    }
}
