<x-app-layout>
    <!-- Header Slot -->
    <x-slot name="header">
        <!-- Menampilkan judul halaman di header -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} <!-- Menampilkan teks 'Dashboard' -->
        </h2>
    </x-slot>

    <!-- Konten Utama Halaman -->
    <div class="py-12">
        <!-- Membuat container untuk konten dengan lebar maksimum 7xl dan padding yang menyesuaikan layar -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Membuat kotak untuk konten dengan latar belakang putih dan bayangan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Menggunakan padding dan teks berwarna abu-abu -->
                <div class="p-6 text-gray-900">
                    <!-- Menampilkan pesan bahwa pengguna sudah login dan menyapa dokter dengan nama -->
                    {{ __("You're logged in! Welcome Dokter") }} <!-- Teks selamat datang untuk dokter -->
                    {{ Auth::user()->nama }} <!-- Menampilkan nama pengguna (dokter) yang sedang login -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
