<x-app-layout>
    <!-- Header bagian profil, menampilkan judul 'Profile' -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <!-- Konten utama untuk bagian profil -->
    <div class="py-12">
        <!-- Menyusun konten dalam sebuah kontainer dengan padding, lebar maksimum, dan ruang antar elemen -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Bagian untuk memperbarui informasi profil -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Menyertakan formulir pembaruan informasi profil -->
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Bagian untuk memperbarui kata sandi -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Menyertakan formulir pembaruan kata sandi -->
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Bagian untuk menghapus akun pengguna -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Menyertakan formulir untuk menghapus akun pengguna -->
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
