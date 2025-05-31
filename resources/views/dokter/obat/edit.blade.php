<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <!-- Header untuk form edit data obat -->
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Data Obat') }}
                            </h2>

                            <!-- Deskripsi singkat mengenai form edit obat -->
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi obat sesuai dengan nama, kemasan, dan harga terbaru.') }}
                            </p>

                        </header>

                        <!-- Form untuk mengedit data obat -->
                        <form class="mt-6" action="{{ route('dokter.obat.update', $obat->id) }}" method="POST">
                            @csrf <!-- Token CSRF untuk melindungi dari serangan CSRF -->
                            @method('PATCH') <!-- Menggunakan metode PATCH untuk update data yang sudah ada -->

                            <!-- Input untuk nama obat -->
                            <div class="mb-3 form-group">
                                <label for="editNamaObatInput">Nama</label>
                                <!-- Input teks yang sudah terisi dengan nama obat yang akan diubah -->
                                <input type="text" class="rounded form-control" id="editNamaObatInput"
                                    value="{{ $obat->nama_obat }}" name="nama_obat">
                            </div>

                            <!-- Input untuk kemasan obat -->
                            <div class="mb-3 form-group">
                                <label for="editKemasanInput">Kemasan</label>
                                <!-- Input teks yang sudah terisi dengan kemasan obat yang akan diubah -->
                                <input type="text" class="rounded form-control" id="editKemasanInput"
                                    value="{{ $obat->kemasan }}" name="kemasan">
                            </div>

                            <!-- Input untuk harga obat -->
                            <div class="mb-3 form-group">
                                <label for="editHargaInput">Harga</label>
                                <!-- Input teks yang sudah terisi dengan harga obat yang akan diubah -->
                                <input type="text" class="rounded form-control" id="editHargaInput"
                                    value="{{ $obat->harga }}" name="harga">
                            </div>

                            <!-- Tombol Batal yang mengarahkan pengguna kembali ke daftar obat -->
                            <a type="button" href="{{ route('dokter.obat.index') }}" class="btn btn-secondary">
                                Batal
                            </a>

                            <!-- Tombol untuk menyimpan perubahan -->
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
