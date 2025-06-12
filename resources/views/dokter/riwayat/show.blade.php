<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Pemeriksaan Pasien: ' . $pasien->nama) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <!-- Menampilkan informasi pasien -->
                <header class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Riwayat Pemeriksaan Pasien') }}
                    </h2>
                </header>

                <!-- Tabel untuk menampilkan riwayat pemeriksaan pasien -->
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Periksa</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Obat</th>
                            <th scope="col">Biaya Pemeriksaan</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $key => $periksa)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $periksa->tgl_periksa }}</td>
                                <!-- Menampilkan keluhan dari janji_periksa -->
                                <td class="align-middle text-start">
                                    {{ $periksa->janjiPeriksa->keluhan ?? 'Tidak ada keluhan' }}
                                </td>
                                <td class="align-middle text-start">{{ $periksa->catatan }}</td>

                                <!-- Menampilkan nama obat berdasarkan id_obat -->
                                <td class="align-middle text-start">
                                    @foreach ($periksa->detailPeriksas as $detail)
                                        @if ($detail->obat)
                                            {{ $detail->obat->nama_obat }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="align-middle text-start">Rp. {{ number_format($periksa->biaya_periksa, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($riwayat->isEmpty())
                    <p class="mt-4 text-gray-600">Pasien ini belum memiliki riwayat pemeriksaan.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
