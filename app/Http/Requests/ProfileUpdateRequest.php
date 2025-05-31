<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna yang sedang login diizinkan untuk melakukan request ini.
     * Pada kasus ini, selalu mengembalikan true yang berarti semua pengguna yang login diperbolehkan melakukan update.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Pastikan pengguna yang login boleh melakukan update
    }

    /**
     * Mendefinisikan aturan validasi untuk setiap input yang diterima.
     * Aturan ini memastikan bahwa data yang dikirimkan oleh pengguna sesuai dengan yang diharapkan.
     * Misalnya, 'nama' harus diisi dan berupa string, 'email' harus valid dan unik untuk pengguna yang sedang login.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',         // 'nama' harus diisi, berupa string, dan maksimal 255 karakter
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(), // 'email' harus valid, maksimal 255 karakter, dan unik kecuali untuk email pengguna yang sedang login
            'alamat' => 'required|string|max:255',       // 'alamat' harus diisi, berupa string, dan maksimal 255 karakter
            'no_hp' => 'required|string|max:20',          // 'no_hp' harus diisi, berupa string, dan maksimal 20 karakter
            'no_ktp' => 'required|string|max:20',         // 'no_ktp' harus diisi, berupa string, dan maksimal 20 karakter
            'poli' => 'nullable|string|max:255',          // 'poli' bersifat opsional, jika ada maka berupa string dan maksimal 255 karakter
        ];
    }

    /**
     * Fungsi untuk menangani update profil pengguna.
     * Data yang telah divalidasi akan diambil dan disimpan ke dalam database.
     * Selain itu, jika email pengguna diubah, kolom 'email_verified_at' akan direset ke null,
     * yang menandakan pengguna harus memverifikasi emailnya kembali.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Debugging: tampilkan data yang telah divalidasi sebelum disimpan
        dd($request->validated());

        // Mengambil data yang sudah divalidasi dan mengisi kolom-kolom yang sesuai pada model pengguna
        $request->user()->fill($request->validated());

        // Mengecek apakah ada perubahan pada kolom email, jika ada maka set 'email_verified_at' menjadi null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Menyimpan perubahan data pengguna
        $request->user()->save();

        // Mengarahkan kembali ke halaman profil edit dan memberikan status bahwa profil telah diperbarui
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
