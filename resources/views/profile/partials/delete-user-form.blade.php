<section class="space-y-6"> <!-- Membuat section dengan jarak vertikal antar elemen sebesar 6 unit -->
    <header>
        <!-- Menampilkan judul bagian dengan ukuran font besar dan tebal -->
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <!-- Menampilkan teks penjelasan terkait dengan penghapusan akun, dengan gaya teks lebih kecil -->
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Tombol untuk membuka modal konfirmasi penghapusan akun -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <!-- Modal konfirmasi penghapusan akun -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf <!-- Menyisipkan token CSRF untuk keamanan -->
            @method('delete') <!-- Menyertakan metode DELETE untuk penghapusan akun -->

            <!-- Menampilkan judul modal -->
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <!-- Menampilkan teks penjelasan di dalam modal -->
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <!-- Kolom untuk memasukkan password sebagai konfirmasi untuk menghapus akun -->
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" /> <!-- Label password yang tersembunyi -->

                <!-- Kolom input untuk password -->
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <!-- Menampilkan pesan error jika ada kesalahan validasi untuk password -->
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Tombol untuk membatalkan atau mengonfirmasi penghapusan akun -->
            <div class="mt-6 flex justify-end">
                <!-- Tombol untuk membatalkan penghapusan akun -->
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <!-- Tombol untuk mengonfirmasi penghapusan akun -->
                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
