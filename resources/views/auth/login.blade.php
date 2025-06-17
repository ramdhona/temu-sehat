<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Menampilkan status pesan jika ada session status (misal: jika login gagal atau sukses) -->

    <!-- Formulir Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Menambahkan token CSRF untuk melindungi dari serangan CSRF (Cross-Site Request Forgery) -->

        <!-- Input Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <!-- Menampilkan label untuk input email -->

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <!-- Input email dengan beberapa atribut:
                 - type="email" memastikan input adalah email
                 - :value="old('email')" menjaga nilai lama input jika ada error
                 - required memastikan field ini harus diisi
                 - autofocus memberikan fokus otomatis pada kolom ini saat halaman dimuat
                 - autocomplete="username" memberikan saran otomatis untuk username/email -->

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <!-- Menampilkan error jika ada kesalahan validasi pada input email -->
        </div>

        <!-- Input Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <!-- Menampilkan label untuk input password -->

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <!-- Input password dengan atribut:
                 - type="password" untuk menyembunyikan karakter input
                 - required memastikan field ini harus diisi
                 - autocomplete="current-password" membantu mengisi password yang sudah ada -->

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <!-- Menampilkan error jika ada kesalahan validasi pada input password -->
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <!-- Label untuk checkbox "remember me" -->

                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <!-- Checkbox untuk "remember me" agar pengguna tetap login saat sesi berakhir -->

                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                <!-- Teks "Remember me" yang ditampilkan di sebelah checkbox -->
            </label>
        </div>

        <!-- Link Forgot Password and Submit Button -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <!-- Jika rute untuk reset password ada, tampilkan link untuk mereset password -->
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Tombol Login -->
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
                <!-- Tombol untuk login, teks yang ditampilkan adalah 'Log in' -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
