<x-app-layout>
    <!-- Slot untuk header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }} <!-- Menampilkan teks 'Dashboard' -->
        </h2>
    </x-slot>

    <!-- Konten Utama Halaman -->
    <div class="py-12">
        <!-- Container dengan lebar maksimum 7xl dan padding yang menyesuaikan layar -->
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Kotak dengan latar belakang putih dan bayangan untuk menampilkan konten -->
            <div class="overflow-hidden bg-blue-500 shadow-sm sm:rounded-lg mb-4">
                <!-- Menampilkan pesan selamat datang di dalam kontainer -->
                <div class="p-6 text-white">
                    {{ __('Selamat Datang') }} {{ Auth::user()->nama }} <!-- Menampilkan nama pengguna -->
                </div>
            </div>


            <!-- Menambahkan baris untuk menampilkan card -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Card Riwayat Janji Periksa Belum Diperiksa -->
                <div class="col-span-1">
                    <div class="bg-red-500 p-6 rounded-lg shadow-md text-white flex items-center justify-between">
                        <!-- Icon dan Judul -->
                        <div class="flex items-center gap-4">
                            <i class="fas fa-clock fa-3x"></i>
                            <div>
                                <h3 class="text-lg font-medium">Belum Diperiksa</h3>
                                <p class="text-2xl font-semibold">{{ $belumDiperiksaCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Riwayat Janji Periksa Sudah Diperiksa -->
                <div class="col-span-1">
                    <div class="bg-green-500 p-6 rounded-lg shadow-md text-white flex items-center justify-between">
                        <!-- Icon dan Judul -->
                        <div class="flex items-center gap-4">
                            <i class="fas fa-check-circle fa-3x"></i>
                            <div>
                                <h3 class="text-lg font-medium">Sudah Diperiksa</h3>
                                <p class="text-2xl font-semibold">{{ $sudahDiperiksaCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
