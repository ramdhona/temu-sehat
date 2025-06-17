<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Data Obat yang Dihapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat yang Dihapus') }}
                        </h2>
                    </header>

                    {{-- Menampilkan pesan sukses jika ada --}}
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

                    {{-- Menampilkan pesan error jika ada --}}
                    @if (session('error'))
                        <script type="text/javascript">
                            Swal.fire({
                                title: 'Error!',
                                text: '{{ session('error') }}',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif

                    {{-- Menampilkan pesan jika tidak ada obat yang dihapus --}}
                    @if ($obats->isEmpty())
                        <p class="text-center text-gray-500 mt-4">Tidak ada data obat yang dihapus</p>
                    @else
                        {{-- Menampilkan tabel jika ada data obat yang dihapus --}}
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
                                {{-- Looping untuk menampilkan setiap data obat yang dihapus --}}
                                @foreach ($obats as $obat)
                                    <tr>
                                        {{-- Menampilkan nomor urut --}}
                                        <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                        {{-- Menampilkan nama obat --}}
                                        <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                        {{-- Menampilkan kemasan obat --}}
                                        <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                        {{-- Menampilkan harga obat dalam format Rupiah --}}
                                        <td class="align-middle text-start">
                                            {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="flex items-center gap-3">
                                            {{-- Tombol untuk mengembalikan (restore) obat yang dihapus --}}
                                            <a href="{{ route('dokter.obat.restore', $obat->id) }}"
                                                class="btn btn-success btn-sm">Restore</a>

                                            {{-- Form untuk menghapus obat secara permanen --}}
                                            <form action="{{ route('dokter.obat.permanentDelete', $obat->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus
                                                    Permanen</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
