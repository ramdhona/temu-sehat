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

                    <!-- Menampilkan alert menggunakan JavaScript jika ada session 'success' -->
                    @if(session('success'))
                        <script type="text/javascript">
                            alert("{{ session('success') }}");
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
                                    <!-- Menampilkan nomor urut -->
                                    <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>

                                    <!-- Menampilkan nama obat -->
                                    <td class="align-middle text-start">{{ $obat->nama_obat }}</td>

                                    <!-- Menampilkan kemasan obat -->
                                    <td class="align-middle text-start">{{ $obat->kemasan }}</td>

                                    <!-- Menampilkan harga obat dengan format Rp (Rupiah) -->
                                    <td class="align-middle text-start">
                                        {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                    </td>

                                    <td class="flex items-center gap-3">
                                        <!-- Tombol Edit untuk mengedit data obat -->
                                        <a href="{{ route('dokter.obat.edit', $obat->id) }}" class="btn btn-secondary btn-sm">Edit</a>

                                        <!-- Form untuk menghapus data obat -->
                                        <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <!-- Tombol Delete untuk menghapus data obat -->
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
</x-app-layout>
