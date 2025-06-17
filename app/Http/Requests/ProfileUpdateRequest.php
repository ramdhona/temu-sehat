<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna yang sedang login diizinkan untuk melakukan request ini.
     *
     * Fungsi ini memeriksa apakah pengguna yang sedang login memiliki izin untuk melakukan 
     * permintaan pembaruan profil. Dalam kasus ini, selalu mengembalikan `true`, yang berarti
     * bahwa setiap pengguna yang sedang login dapat mengupdate profil mereka.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Pastikan pengguna yang login boleh melakukan update
    }

    /**
     * Mendefinisikan aturan validasi untuk setiap input yang diterima.
     *
     * Fungsi ini menetapkan aturan validasi untuk setiap field dalam permintaan profil yang diperbarui.
     * Aturan validasi ini digunakan untuk memastikan bahwa data yang dimasukkan oleh pengguna memenuhi 
     * persyaratan tertentu. Jika ada input yang tidak valid, maka permintaan akan gagal dan pesan 
     * kesalahan akan dikembalikan.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255', // Nama harus ada, berupa string, dan tidak lebih dari 255 karakter
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(), // Email harus valid, unik di tabel 'users' kecuali untuk pengguna yang sedang login
            'alamat' => 'required|string|max:255', // Alamat harus ada, berupa string, dan tidak lebih dari 255 karakter
            'no_hp' => 'required|string|max:20', // Nomor HP harus ada, berupa string, dan tidak lebih dari 20 karakter
            'no_ktp' => 'required|string|max:20', // Nomor KTP harus ada, berupa string, dan tidak lebih dari 20 karakter
            'poli_id' => 'nullable|exists:polis,id',  // Poli ID bersifat opsional, tetapi jika ada, harus ada dalam tabel 'polis' dan memiliki ID yang valid
        ];
    }
}
