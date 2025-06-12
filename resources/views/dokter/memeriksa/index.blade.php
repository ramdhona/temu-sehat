<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <!-- Header untuk menampilkan judul dan tombol untuk menambah jadwal -->
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Jadwal Periksa') }}
                    </h2>

                    <div class="flex-col items-center justify-center text-center">
                        <!-- Tombol untuk menambah jadwal baru -->
                        <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>

                        <!-- Menampilkan pesan sukses jika status session adalah 'jadwal-created' -->
                        @if (session('status') === 'jadwal-created')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">
                                {{ __('Jadwal berhasil dibuat.') }}
                            </p>
                        @endif
                    </div>
                </header>

                <!-- Menampilkan alert menggunakan JavaScript jika ada session 'success' -->
                @if (session('success'))
                    <script type="text/javascript">
                        alert("{{ session('success') }}");
                    </script>
                @endif

                <!-- Tabel untuk menampilkan daftar jadwal pemeriksaan -->
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No Urut</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan semua jadwal -->
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <!-- Menampilkan nomor urut jadwal -->
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <!-- Menampilkan hari jadwal -->
                                <td class="align-middle text-start">{{ $jadwal->hari }}</td>
                                <!-- Menampilkan jam mulai jadwal -->
                                <td class="align-middle text-start">{{ $jadwal->jam_mulai }}</td>
                                <!-- Menampilkan jam selesai jadwal -->
                                <td class="align-middle text-start">{{ $jadwal->jam_selesai }}</td>
                                <td class="align-middle text-start">
                                    <!-- Menampilkan badge dengan status 'aktif' atau 'nonaktif' berdasarkan nilai boolean -->
                                    <span
                                        class="badge {{ $jadwal->status == 1 ? 'bg-success' : 'bg-danger' }} text-white fw-bold fs-5">
                                        {{ $jadwal->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>


                                <td class="flex items-center gap-3">
                                    {{-- Tombol untuk mengubah status --}}
                                    <form action="{{ route('dokter.jadwal.status', $jadwal->id) }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <!-- Tombol untuk mengaktifkan atau menonaktifkan jadwal -->
                                        <button type="submit"
                                            class="btn {{ $jadwal->status == 1 ? 'btn-warning' : 'btn-success' }} btn-sm">
                                            {{ $jadwal->status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    {{-- Tombol untuk menghapus jadwal --}}
                                    <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Tombol untuk menghapus jadwal -->
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
