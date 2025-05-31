<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <!-- Header untuk form tambah jadwal -->
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Form Tambah Jadwal Periksa') }}
                        </h2>
                    </header>

                    <!-- Form untuk menambahkan jadwal baru -->
                    <form action="{{ route('dokter.jadwal.store') }}" method="POST">
                        @csrf <!-- Token CSRF untuk melindungi form dari serangan CSRF -->

                        <div class="space-y-6">
                            <!-- Input untuk memilih hari jadwal -->
                            <div>
                                <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                <!-- Dropdown untuk memilih hari (Senin - Minggu) -->
                                <select name="hari" id="hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>

                            <!-- Input untuk memilih jam mulai jadwal -->
                            <div>
                                <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <!-- Input tipe time untuk memilih jam mulai -->
                                <input type="time" name="jam_mulai" id="jam_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            </div>

                            <!-- Input untuk memilih jam selesai jadwal -->
                            <div>
                                <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                <!-- Input tipe time untuk memilih jam selesai -->
                                <input type="time" name="jam_selesai" id="jam_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            </div>

                            <!-- Tombol untuk menyimpan jadwal yang baru -->
                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
