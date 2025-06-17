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
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>

                        <!-- Tombol untuk menambah obat dan cek data yang dihapus -->
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.create') }}" class="btn btn-primary">Tambah Obat</a>
                            <a href="{{ route('dokter.obat.deleted') }}" class="btn btn-warning ">Cek Data yang
                                Dihapus</a>
                        </div>
                    </header>

                    <!-- Menampilkan notifikasi success jika ada pesan sukses -->
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

                    <!-- Menampilkan tabel daftar obat -->
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
                            <!-- Loop untuk menampilkan data obat -->
                            @foreach ($obats as $obat)
                                <tr>
                                    <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                    <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                    <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                    <td class="align-middle text-start">
                                        {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="flex items-center gap-3">
                                        <!-- Tombol untuk mengedit obat -->
                                        <a href="{{ route('dokter.obat.edit', $obat->id) }}"
                                            class="btn btn-secondary btn-sm">Edit</a>

                                        <!-- Jika obat telah dihapus (soft delete), tampilkan tombol restore -->
                                        @if ($obat->trashed())
                                            <!-- Soft Deleted -->
                                            <a href="{{ route('dokter.obat.restore', $obat->id) }}"
                                                class="btn btn-success btn-sm">Restore</a>
                                        @else
                                            <!-- Jika obat belum dihapus, tampilkan tombol delete -->
                                            <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete(event)">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <script>
        // Fungsi konfirmasi penghapusan obat
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form submit secara langsung

            // Menampilkan konfirmasi menggunakan SweetAlert2
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data obat akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika tombol "Ya, Hapus!" ditekan, form akan disubmit
                if (result.isConfirmed) {
                    event.target.closest('form').submit(); // Menyubmit form untuk menghapus data
                }
            });
        }
    </script>

    <!-- Memuat SweetAlert2 dari CDN untuk menampilkan notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
