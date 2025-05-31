<section>
    <header>
        <!-- Menampilkan judul untuk bagian pembaruan informasi profil pengguna -->
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <!-- Deskripsi singkat yang memberi tahu pengguna untuk memperbarui informasi profil dan email mereka -->
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Form untuk mengirimkan permintaan untuk mengirim ulang email verifikasi -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf <!-- Menyisipkan token CSRF untuk keamanan -->
    </form>

    <!-- Form untuk memperbarui profil pengguna -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf <!-- Menyisipkan token CSRF untuk keamanan -->
        @method('patch') <!-- Menyertakan metode PATCH untuk memperbarui data profil -->

        <!-- Kolom input untuk memperbarui nama pengguna -->
        <div>
            <x-input-label for="nama" :value="__('Nama')" /> <!-- Label untuk kolom Nama -->
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required autofocus autocomplete="name" /> <!-- Input untuk nama dengan nilai default adalah nama yang sudah ada -->
            <x-input-error class="mt-2" :messages="$errors->get('nama')" /> <!-- Menampilkan pesan error jika ada -->
        </div>

        <!-- Kolom input untuk memperbarui email pengguna -->
        <div>
            <x-input-label for="email" :value="__('Email')" /> <!-- Label untuk kolom email -->
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" /> <!-- Input untuk email -->
            <x-input-error class="mt-2" :messages="$errors->get('email')" /> <!-- Menampilkan pesan error jika ada -->

            <!-- Menampilkan status jika email pengguna belum terverifikasi dan memberikan opsi untuk mengirim ulang email verifikasi -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    <!-- Menampilkan pesan bahwa email verifikasi baru telah dikirimkan -->
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Kolom input untuk memperbarui alamat pengguna -->
        <div>
            <x-input-label for="alamat" :value="__('Alamat')" /> <!-- Label untuk kolom alamat -->
            <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat', $user->alamat)" required autofocus autocomplete="address" /> <!-- Input untuk alamat -->
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" /> <!-- Menampilkan pesan error jika ada -->
        </div>

        <!-- Kolom input untuk memperbarui nomor HP pengguna -->
        <div>
            <x-input-label for="no_hp" :value="__('Nomor HP')" /> <!-- Label untuk kolom nomor HP -->
            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->no_hp)" required autocomplete="tel" /> <!-- Input untuk nomor HP -->
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" /> <!-- Menampilkan pesan error jika ada -->
        </div>

        <!-- Kolom input untuk memperbarui nomor KTP pengguna -->
        <div>
            <x-input-label for="no_ktp" :value="__('Nomor KTP')" /> <!-- Label untuk kolom nomor KTP -->
            <x-text-input id="no_ktp" name="no_ktp" type="text" class="mt-1 block w-full" :value="old('no_ktp', $user->no_ktp)" required autocomplete="id_number" /> <!-- Input untuk nomor KTP -->
            <x-input-error class="mt-2" :messages="$errors->get('no_ktp')" /> <!-- Menampilkan pesan error jika ada -->
        </div>

        <!-- Kolom input untuk memperbarui informasi poli -->
        <div>
            <x-input-label for="poli" :value="__('Poli')" /> <!-- Label untuk kolom poli -->
            <x-text-input id="poli" name="poli" type="text" class="mt-1 block w-full" :value="old('poli', $user->poli)" /> <!-- Input untuk poli -->
            <x-input-error class="mt-2" :messages="$errors->get('poli')" /> <!-- Menampilkan pesan error jika ada -->
        </div>

        <!-- Tombol untuk menyimpan perubahan profil pengguna -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <!-- Menampilkan pesan konfirmasi jika profil berhasil diperbarui -->
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)" <!-- Pesan akan menghilang setelah 2 detik -->
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
