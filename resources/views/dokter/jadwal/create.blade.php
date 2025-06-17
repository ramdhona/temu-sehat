<x-app-layout>
    <!-- Slot untuk header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Container utama untuk konten dengan lebar maksimum 7xl dan padding otomatis -->
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <!-- Header bagian atas form -->
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Form Tambah Jadwal Periksa') }}
                        </h2>
                    </header>

                    <!-- Formulir untuk menambahkan jadwal pemeriksaan -->
                    <form action="{{ route('dokter.jadwal.store') }}" method="POST">
                        @csrf <!-- Token CSRF digunakan untuk melindungi form dari serangan CSRF -->

                        <div class="space-y-6">
                            <!-- Dropdown untuk memilih hari jadwal -->
                            <div>
                                <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                <!-- Dropdown untuk memilih hari, yang terdiri dari Senin hingga Minggu -->
                                <select name="hari" id="hari"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>

                            <!-- Input untuk memilih jam mulai dan jam selesai menggunakan dua input time yang berada dalam satu baris -->
                            <div class="flex space-x-4">
                                <!-- Kolom untuk jam mulai -->
                                <div class="w-1/2">
                                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam
                                        Mulai</label>
                                    <input type="time" name="jam_mulai" id="jam_mulai"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required>
                                </div>

                                <!-- Kolom untuk jam selesai -->
                                <div class="w-1/2">
                                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam
                                        Selesai</label>
                                    <input type="time" name="jam_selesai" id="jam_selesai"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required>
                                </div>
                            </div>

                            <!-- Tombol untuk mengirimkan form dan menyimpan jadwal baru -->
                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <!-- Menyertakan CDN SweetAlert2 untuk menampilkan alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Menampilkan SweetAlert2 jika ada session 'error' -->
    @if (session('error'))
        <script type="text/javascript">
            // Menampilkan SweetAlert dengan tipe error jika ada pesan error di session
            Swal.fire({
                icon: 'error', // Tipe alert adalah error
                title: 'Oops...', // Judul alert
                text: '{{ session('error') }}', // Menampilkan pesan error yang diteruskan dari controller
            });
        </script>
    @endif
</x-app-layout>
