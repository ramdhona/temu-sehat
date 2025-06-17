<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Poli Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Form untuk menambah poli -->
                <form method="POST" action="{{ route('dokter.poli.store') }}">
                    @csrf

                    <div>
                        <!-- Label untuk input nama poli -->
                        <x-input-label for="nama_poli" :value="__('Nama Poli')" />
                        <!-- Input untuk nama poli -->
                        <x-text-input id="nama_poli" name="nama_poli" type="text" class="mt-1 block w-full" required
                            autofocus />
                        <!-- Menampilkan pesan error jika ada kesalahan pada input 'nama_poli' -->
                        <x-input-error class="mt-2" :messages="$errors->get('nama_poli')" />
                    </div>

                    <div class="mt-4">
                        <!-- Tombol untuk menyimpan data poli -->
                        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
