<x-app-layout>
    <!-- Bagian Header -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Box untuk Formulir Janji Periksa -->
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Buat Janji Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Atur jadwal pertemuan dengan dokter untuk mendapatkan layanan konsultasi dan pemeriksaan kesehatan sesuai kebutuhan Anda.') }}
                            </p>
                        </header>

                        <!-- Form untuk menambahkan janji periksa -->
                        <form class="mt-6" action="{{ route('pasien.janji-periksa.store') }}" method="POST">
                            @csrf
                            <!-- Input untuk Nomor Rekam Medis -->
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nomor Rekam Medis</label>
                                <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                    placeholder="Example input" value="{{ $no_rm }}" readonly>
                            </div>

                            <!-- Dropdown untuk memilih dokter -->
                            <div class="form-group">
                                <label for="dokterSelect">Dokter</label>
                                <select class="form-control" name="id_dokter" id="dokterSelect" required>
                                    <option>Pilih Dokter</option>
                                    <!-- Menampilkan dokter dan jadwal periksa -->
                                    @foreach ($dokters as $dokter)
                                        @foreach ($dokter->jadwalPeriksas as $jadwal)
                                            <option value="{{ $dokter->id }}">
                                                {{ $dokter->nama }} - Spesialis {{ $dokter->poli }} |
                                                {{ $jadwal->hari }},
                                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }} -
                                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input untuk menuliskan keluhan pasien -->
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea class="form-control" name="keluhan" id="keluhan" rows="3" required></textarea>
                            </div>

                            <!-- Tombol submit untuk mengirim form -->
                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Menampilkan SweetAlert ketika berhasil membuat janji
        @if (session('status') === 'janji-periksa-created')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Janji periksa Anda berhasil dibuat.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</x-app-layout>
