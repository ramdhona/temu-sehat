<x-app-layout>
    <x-slot name="header">
        <!-- Menampilkan header dengan judul 'Riwayat Pemeriksaan Pasien' -->
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Pemeriksaan Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <!-- Header untuk menampilkan judul halaman -->
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Riwayat Pemeriksaan Pasien') }}
                    </h2>
                </header>

                <!-- Tabel untuk menampilkan daftar pasien -->
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan data pasien -->
                        @foreach ($pasien as $key => $p)
                            <tr>
                                <!-- Menampilkan nomor urut pasien, menggunakan $loop->iteration -->
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>

                                <!-- Menampilkan nama pasien -->
                                <td class="align-middle text-start">{{ $p->nama }}</td>

                                <!-- Menampilkan alamat pasien -->
                                <td class="align-middle text-start">{{ $p->alamat }}</td>

                                <!-- Menampilkan nomor KTP pasien -->
                                <td class="align-middle text-start">{{ $p->no_ktp }}</td>

                                <!-- Menampilkan nomor HP pasien -->
                                <td class="align-middle text-start">{{ $p->no_hp }}</td>

                                <!-- Tombol untuk melihat riwayat pemeriksaan pasien -->
                                <td class="flex items-center gap-3">
                                    {{-- Tombol untuk melihat riwayat pemeriksaan pasien --}}
                                    <a href="{{ route('dokter.riwayat-periksa.show', $p->id) }}"
                                        class="btn btn-info btn-sm">Lihat Riwayat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
