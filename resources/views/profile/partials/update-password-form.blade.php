<section>
    <header>
        <!-- Menampilkan judul halaman untuk memperbarui kata sandi -->
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <!-- Deskripsi singkat yang memberikan saran untuk menggunakan kata sandi yang kuat dan acak -->
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- Formulir untuk memperbarui kata sandi -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf <!-- Menyisipkan token CSRF untuk keamanan -->
        @method('put') <!-- Menyertakan metode PUT untuk memperbarui data -->

        <!-- Kolom input untuk memasukkan kata sandi saat ini -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Kolom input untuk memasukkan kata sandi baru -->
        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Kolom input untuk konfirmasi kata sandi baru -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Tombol untuk menyimpan perubahan dan menampilkan pesan konfirmasi -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <!-- Pesan konfirmasi jika kata sandi berhasil diperbarui -->
            @if (session('status') === 'password-updated')
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
