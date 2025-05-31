<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"> <!-- Menentukan set karakter yang digunakan (UTF-8) untuk halaman HTML -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Membuat halaman responsif pada berbagai ukuran layar -->
        <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Menyisipkan token CSRF untuk melindungi aplikasi dari serangan CSRF -->

        <title>{{ config('app.name', 'Laravel') }}</title> <!-- Menampilkan judul halaman, nama aplikasi Laravel atau nama yang telah dikonfigurasi -->

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net"> <!-- Menyiapkan koneksi awal untuk font -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> <!-- Menambahkan font Figtree untuk digunakan dalam halaman -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Menyertakan file CSS dan JS menggunakan Vite (sistem bundling untuk Laravel) -->

        {{-- Bootstrap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> <!-- Menambahkan Bootstrap CSS dari CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> <!-- Menambahkan jQuery dari CDN -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> <!-- Menambahkan Popper.js dari CDN (digunakan oleh Bootstrap) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> <!-- Menambahkan Bootstrap JS dari CDN -->
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100"> <!-- Membuat tampilan halaman dengan background abu-abu dan tinggi minimal sepanjang layar -->
            @include('layouts.navigation') <!-- Menyertakan file layout navigasi (misalnya menu atas atau sidebar) -->

            <!-- Page Heading -->
            @isset($header) <!-- Jika variabel $header ada (terdefinisi), tampilkan bagian ini -->
                <header class="bg-white shadow"> <!-- Menambahkan background putih dengan bayangan -->
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"> <!-- Membatasi lebar maksimum dan menambahkan padding -->
                        {{ $header }} <!-- Menampilkan konten dari variabel $header -->
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }} <!-- Menampilkan konten utama yang diteruskan ke halaman melalui slot -->
            </main>
        </div>
    </body>
</html>
