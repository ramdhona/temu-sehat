<x-app-layout>
    <!-- Slot untuk header halaman -->
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Pemeriksaan Pasien: ') }} {{ $janjiPeriksa->pasien->nama }}
            <!-- Menampilkan nama pasien yang sedang diperiksa -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Kotak untuk menampilkan form edit pemeriksaan -->
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <!-- Form untuk edit pemeriksaan pasien -->
                    <form action="{{ route('dokter.memeriksa.update', $janjiPeriksa->id) }}" method="POST">
                        @csrf
                        @method('POST') <!-- Menandakan bahwa ini adalah metode POST untuk pengiriman data -->

                        <!-- Nama Pasien (Readonly) -->
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" id="nama_pasien" class="form-control"
                                value="{{ $janjiPeriksa->pasien->nama }}" readonly>
                        </div>

                        <!-- No RM (Readonly) -->
                        <div class="form-group">
                            <label for="no_rm">No RM</label>
                            <input type="text" id="no_rm" class="form-control"
                                value="{{ $janjiPeriksa->pasien->no_rm }}" readonly>
                        </div>

                        <!-- Tanggal Pemeriksaan -->
                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Pemeriksaan</label>
                            <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control"
                                value="{{ old('tgl_periksa', \Carbon\Carbon::parse($janjiPeriksa->periksa->tgl_periksa)->format('Y-m-d')) }}"
                                required>
                        </div>

                        <!-- Catatan Pemeriksaan -->
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="4" required>{{ old('catatan', $janjiPeriksa->periksa->catatan) }}</textarea>
                        </div>

                        <!-- Pilih Obat dengan Select2 -->
                        <div class="form-group">
                            <label for="obat">Pilih Obat</label>
                            <select name="obat[]" id="obat" class="form-control" multiple required>
                                @foreach ($obats as $obat)
                                    <!-- Menambahkan opsi obat yang sudah dipilih berdasarkan relasi dengan pemeriksaan sebelumnya -->
                                    <option value="{{ $obat->id }}" data-price="{{ $obat->harga }}"
                                        @if ($janjiPeriksa->periksa->obats->contains($obat->id)) selected @endif>
                                        {{ $obat->nama_obat }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga Obat -->
                        <div class="form-group">
                            <label for="harga_obat">Harga Obat</label>
                            <input type="text" id="harga_obat" class="form-control" value="Rp 0" readonly>
                        </div>

                        <!-- Biaya Pemeriksaan -->
                        <div class="form-group">
                            <label for="biaya_periksa">Biaya Pemeriksaan</label>
                            <input type="text" name="biaya_periksa" class="form-control" value="Rp 150.000" readonly>
                        </div>

                        <!-- Total Pembayaran -->
                        <div class="form-group">
                            <label for="total_pembayaran">Total Pembayaran</label>
                            <input type="text" id="total_pembayaran" class="form-control" value="Rp 150.000"
                                readonly>
                        </div>

                        <!-- Tombol untuk mengirimkan form -->
                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Menghitung Harga Obat dan Total Pembayaran -->
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada elemen pilihan obat
            $('#obat').select2({
                placeholder: "Pilih Obat", // Placeholder untuk dropdown
                allowClear: true, // Menambahkan opsi untuk membersihkan pilihan
            });

            // Fungsi untuk menghitung harga obat yang dipilih dan total pembayaran
            function calculatePrice() {
                let selectedOptions = document.getElementById('obat').selectedOptions;
                let totalHargaObat = 0;

                // Mengakumulasi harga obat yang dipilih
                for (let option of selectedOptions) {
                    totalHargaObat += parseInt(option.getAttribute('data-price'));
                }

                // Menampilkan harga obat yang dipilih
                document.getElementById('harga_obat').value = 'Rp ' + totalHargaObat.toLocaleString();

                // Menghitung total pembayaran dengan biaya pemeriksaan tetap Rp 150.000
                let biayaPeriksa = 150000;
                let totalPembayaran = biayaPeriksa + totalHargaObat;

                // Menampilkan total pembayaran
                document.getElementById('total_pembayaran').value = 'Rp ' + totalPembayaran.toLocaleString();
            }

            // Menambahkan event listener untuk perubahan pada pilihan obat
            $('#obat').on('change', function() {
                calculatePrice(); // Memanggil fungsi perhitungan setiap kali pilihan obat berubah
            });

            // Memanggil fungsi untuk pertama kali agar menghitung harga ketika halaman dimuat
            calculatePrice();
        });
    </script>
</x-app-layout>
