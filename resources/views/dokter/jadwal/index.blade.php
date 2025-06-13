<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Jadwal Periksa') }}
                    </h2>
                    <div class="flex-col items-center justify-center text-center">
                        <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>
                    </div>
                </header>

                <!-- Menampilkan alert menggunakan SweetAlert jika ada session 'success' -->
                @if (session('success'))
                    <script type="text/javascript">
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

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
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $jadwal->hari }}</td>
                                <td class="align-middle text-start">{{ $jadwal->jam_mulai }}</td>
                                <td class="align-middle text-start">{{ $jadwal->jam_selesai }}</td>
                                <td class="align-middle text-start">
                                    <span
                                        class="badge {{ $jadwal->status == 1 ? 'bg-success' : 'bg-danger' }} text-white">
                                        {{ $jadwal->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="flex items-center gap-3">
                                    <!-- Toggle status button -->
                                    <form action="{{ route('dokter.jadwal.status', $jadwal->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            class="btn {{ $jadwal->status == 1 ? 'btn-warning' : 'btn-success' }} btn-sm">
                                            {{ $jadwal->status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    <!-- Delete button with SweetAlert confirmation -->
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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Jadwal ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit(); // Submit the form if confirmed
                }
            });
        }
    </script>

</x-app-layout>
