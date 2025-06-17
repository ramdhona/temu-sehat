<x-app-layout>
    <x-slot name="header">
        <!-- Menampilkan header dengan judul 'Daftar Poli' -->
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Poli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Container utama untuk tampilan daftar poli -->
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Poli') }}
                    </h2>
                    <div class="flex-col items-center justify-center text-center">
                        <!-- Tombol untuk menambahkan poli baru -->
                        <a href="{{ route('dokter.poli.create') }}" class="btn btn-primary">Tambah Poli</a>
                    </div>
                </header>

                <!-- Menampilkan SweetAlert2 untuk pesan sukses -->
                @if (session('success'))
                    <script type="text/javascript">
                        Swal.fire({
                            title: 'Sukses!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                <!-- Tabel untuk menampilkan daftar poli -->
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Poli</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($polis as $poli)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $poli->nama_poli }}</td>
                                <td class="align-middle text-start">
                                    <!-- Tombol Edit untuk mengedit data poli -->
                                    <a href="{{ route('dokter.poli.edit', $poli->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Form untuk menghapus data poli -->
                                    <form action="{{ route('dokter.poli.destroy', $poli->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Tombol untuk menghapus poli dengan konfirmasi -->
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event)">Hapus</button>
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

    <!-- Script konfirmasi penghapusan menggunakan SweetAlert2 -->
    <script>
        // Fungsi untuk mengonfirmasi penghapusan poli
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form disubmit langsung

            // Menampilkan konfirmasi menggunakan SweetAlert2
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Poli ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika tombol "Ya, Hapus!" ditekan, form akan disubmit
                if (result.isConfirmed) {
                    event.target.closest('form').submit(); // Menyubmit form untuk menghapus data poli
                }
            });
        }
    </script>

</x-app-layout>
