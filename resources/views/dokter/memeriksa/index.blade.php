<x-app-layout>
    <!-- Slot untuk header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Periksa Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Kotak untuk menampilkan daftar pasien -->
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <!-- Header untuk daftar periksa pasien -->
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Periksa Pasien') }}
                        </h2>

                        <!-- Tempat untuk tombol aksi lain jika diperlukan -->
                        <div class="flex-col items-center justify-center text-center">
                            <!-- Bisa ditambahkan tombol atau fitur lain untuk interaksi -->
                        </div>
                    </header>

                    <!-- Tabel untuk menampilkan daftar pasien dan status periksa mereka -->
                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No Urut</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Aksi Periksa</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop untuk menampilkan setiap pasien -->
                            @foreach ($pasien as $key => $p)
                                <tr>
                                    <!-- Nomor urut pasien -->
                                    <td>{{ $key + 1 }}</td>

                                    <!-- Nama pasien -->
                                    <td>{{ $p->pasien->nama }}</td>

                                    <!-- Keluhan pasien -->
                                    <td>{{ $p->keluhan }}</td>

                                    <!-- Aksi untuk periksa pasien -->
                                    <td>
                                        @if ($p->periksa)
                                            <!-- Menampilkan status jika pasien sudah diperiksa -->
                                            <span
                                                class="px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded-full">
                                                Sudah Diperiksa
                                            </span>
                                        @else
                                            <!-- Jika pasien belum diperiksa, tampilkan tombol untuk periksa -->
                                            <a href="{{ route('dokter.memeriksa.periksa', $p->id) }}"
                                                class="btn btn-primary">
                                                Periksa
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Tombol untuk mengedit pemeriksaan -->
                                    <td><a href="{{ route('dokter.memeriksa.edit', $p->id) }}"
                                            class="btn btn-warning">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Menampilkan SweetAlert2 jika ada session 'success' -->
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</x-app-layout>
