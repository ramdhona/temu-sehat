<x-app-layout>
    <!-- Slot untuk header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }} <!-- Menampilkan judul halaman 'Jadwal Periksa' -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Container utama untuk tampilan daftar jadwal -->
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <!-- Header bagian atas untuk judul daftar jadwal dan tombol tambah jadwal -->
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Jadwal Periksa') }} <!-- Judul untuk daftar jadwal -->
                    </h2>
                    <div class="flex-col items-center justify-center text-center">
                        <!-- Tombol untuk menambah jadwal baru -->
                        <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>
                    </div>
                </header>

                <!-- Menampilkan alert menggunakan SweetAlert jika ada session 'success' -->
                @if (session('success'))
                    <script type="text/javascript">
                        // Menampilkan alert SweetAlert2 dengan pesan sukses
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ session('success') }}', // Menampilkan pesan sukses dari session
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                <!-- Tabel untuk menampilkan daftar jadwal pemeriksaan -->
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan setiap jadwal -->
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <!-- Menampilkan nomor urut jadwal -->
                                <td class="align-middle text-start">{{ $jadwal->hari }}</td> <!-- Menampilkan hari -->
                                <td class="align-middle text-start">{{ $jadwal->jam_mulai }}</td>
                                <!-- Menampilkan jam mulai -->
                                <td class="align-middle text-start">{{ $jadwal->jam_selesai }}</td>
                                <!-- Menampilkan jam selesai -->
                                <td class="align-middle text-start">
                                    <!-- Menampilkan status dengan badge warna hijau jika aktif, merah jika nonaktif -->
                                    <span
                                        class="badge {{ $jadwal->status == 1 ? 'bg-success' : 'bg-danger' }} text-white">
                                        {{ $jadwal->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="flex items-center gap-3">
                                    <!-- Form untuk toggle status jadwal -->
                                    <form action="{{ route('dokter.jadwal.status', $jadwal->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            class="btn {{ $jadwal->status == 1 ? 'btn-warning' : 'btn-success' }} btn-sm">
                                            {{ $jadwal->status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    <!-- Tombol untuk menghapus jadwal dengan konfirmasi menggunakan SweetAlert2 -->
                                    <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event)">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script untuk konfirmasi penghapusan menggunakan SweetAlert2 -->
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form untuk disubmit langsung

            // Menampilkan dialog konfirmasi penghapusan dengan SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?', // Menampilkan judul konfirmasi
                text: "Jadwal ini akan dihapus permanen!", // Pesan konfirmasi
                icon: 'warning', // Menampilkan ikon peringatan
                showCancelButton: true, // Menampilkan tombol pembatalan
                confirmButtonText: 'Ya, Hapus!', // Teks tombol konfirmasi
                cancelButtonText: 'Batal' // Teks tombol pembatalan
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit(); // Menyubmit form jika konfirmasi berhasil
                }
            });
        }
    </script>

</x-app-layout>
