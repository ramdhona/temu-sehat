<x-guest-layout>
    <!-- Formulir Pendaftaran Pengguna -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Token CSRF digunakan untuk mencegah serangan Cross-Site Request Forgery (CSRF) -->

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="nama" :value="__('Nama Lengkap')" />
            <!-- Label untuk input 'nama' -->

            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required
                autofocus autocomplete="name" />
            <!-- Input text untuk nama lengkap dengan beberapa atribut:
                 - 'old('nama')' menjaga nilai lama input jika ada error atau setelah refresh
                 - 'required' memastikan field ini harus diisi
                 - 'autofocus' memberikan fokus otomatis pada kolom ini ketika halaman dimuat
                 - 'autocomplete="name"' memberikan saran nama saat mengisi form -->

            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'nama' -->
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <!-- Label untuk input 'alamat' -->

            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                required autofocus autocomplete="alamat" />

            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'alamat' -->
        </div>

        <!-- Nomor Induk Kependudukan (KTP) -->
        <div class="mt-4">
            <x-input-label for="no_ktp" :value="__('Nomor Induk Kependudukan')" />
            <!-- Label untuk input 'no_ktp' -->

            <x-text-input id="no_ktp" class="block mt-1 w-full" type="number" name="no_ktp" :value="old('no_ktp')"
                required autofocus autocomplete="no_ktp" />
            <!-- Input text untuk nomor KTP -->

            <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'no_ktp' -->
        </div>

        <!-- Nomor Telepon (No Hp) -->
        <div class="mt-4">
            <x-input-label for="no_hp" :value="__('Nomor Telepon')" />
            <!-- Label untuk input 'no_hp' -->

            <x-text-input id="no_hp" class="block mt-1 w-full" type="number" name="no_hp" :value="old('no_hp')"
                required autofocus autocomplete="no_hp" />
            <!-- Input text untuk nomor telepon -->

            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'no_hp' -->
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <!-- Label untuk input 'email' -->

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <!-- Input email untuk alamat email pengguna -->

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'email' -->
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <!-- Label untuk input 'password' -->

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <!-- Input password untuk mengatur kata sandi pengguna -->

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'password' -->
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <!-- Label untuk input 'password_confirmation' -->

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <!-- Input untuk konfirmasi password -->

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada masalah dengan input 'password_confirmation' -->
        </div>

        <!-- Tombol Daftar dan Link Login -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah Punya Akun ?') }}
                <!-- Link yang mengarah ke halaman login jika pengguna sudah memiliki akun -->
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
                <!-- Tombol untuk mengirimkan form pendaftaran -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
