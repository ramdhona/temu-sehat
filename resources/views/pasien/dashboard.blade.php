<x-app-layout>
    <!-- Slot untuk header halaman -->
    <x-slot name="header">
        <!-- Judul halaman Dashboard -->
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }} <!-- Menampilkan teks 'Dashboard' -->
        </h2>
    </x-slot>

    <!-- Konten Utama Halaman -->
    <div class="py-12">
        <!-- Container dengan lebar maksimum 7xl dan padding yang menyesuaikan layar -->
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Kotak dengan latar belakang putih dan bayangan untuk menampilkan konten -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <!-- Menampilkan pesan selamat datang di dalam kontainer -->
                <div class="p-6 text-gray-900">
                    <!-- Menampilkan pesan selamat datang, termasuk nama pengguna yang sedang login -->
                    {{ __("You're logged in! Welcome ") }} {{ Auth::user()->nama }} <!-- Menampilkan nama pengguna -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
