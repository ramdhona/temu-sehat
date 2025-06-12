<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <!-- Header untuk daftar obat -->
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <!-- Tombol untuk menambah obat baru -->
                            <a href="{{ route('dokter.obat.create') }}" class="btn btn-primary">Tambah Obat</a>
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

                    <!-- Tabel daftar obat -->
                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Kemasan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop untuk menampilkan semua obat -->
                            @foreach ($obats as $obat)
                                <tr>
                                    <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                    <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                    <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                    <td class="align-middle text-start">
                                        {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="flex items-center gap-3">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('dokter.obat.edit', $obat->id) }}"
                                            class="btn btn-secondary btn-sm">Edit</a>

                                        <!-- Tombol Delete dengan konfirmasi menggunakan SweetAlert -->
                                        <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete(event)">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk konfirmasi penghapusan dengan SweetAlert -->
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form untuk submit langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data obat akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit(); // Men-submit form jika pengguna mengkonfirmasi
                }
            });
        }
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
