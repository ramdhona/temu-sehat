<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid untuk menampilkan 4 card -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Card untuk Jumlah Obat -->
                <div class="bg-green-500 p-6 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-pills text-4xl text-white"></i>
                        <div class="text-white">
                            <h3 class="text-xl font-semibold">Jumlah Obat</h3>
                            <p class="text-3xl">{{ $jumlahObat }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card untuk Jumlah Jadwal -->
                <div class="bg-blue-500 p-6 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-calendar-check text-4xl text-white"></i>
                        <div class="text-white">
                            <h3 class="text-xl font-semibold">Jumlah Jadwal</h3>
                            <p class="text-3xl">{{ $jumlahJadwal }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card untuk Jumlah Pasien -->
                <div class="bg-yellow-500 p-6 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-users text-4xl text-white"></i>
                        <div class="text-white">
                            <h3 class="text-xl font-semibold">Jumlah Pasien</h3>
                            <p class="text-3xl">{{ $jumlahPasien }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card untuk Jumlah Pasien yang Belum Diperiksa -->
                <div class="bg-red-500 p-6 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-user-times text-4xl text-white"></i>
                        <div class="text-white">
                            <h3 class="text-xl font-semibold">Pasien Belum Diperiksa</h3>
                            <p class="text-3xl">{{ $jumlahPasienBelumDiperiksa }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Box untuk Menampilkan Pesan -->
            <div class="bg-indigo-500 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-white">
                    <h3 class="text-xl font-semibold">Selamat Datang Kembali</h3>
                    <p class="text-2xl"> Dokter {{ Auth::user()->nama }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke FontAwesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</x-app-layout>
