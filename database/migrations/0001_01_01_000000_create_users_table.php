<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Fungsi ini digunakan untuk membuat tabel di database.
     * Di sini, kita membuat tiga tabel: 'users', 'password_reset_tokens', dan 'sessions'.
     */
    public function up(): void
    {
        // Membuat tabel 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk pengguna
            $table->enum('role', ['dokter', 'pasien']); // Kolom role yang dapat berisi 'dokter' atau 'pasien'
            $table->string('nama'); // Kolom untuk nama pengguna
            $table->string('alamat'); // Kolom untuk alamat pengguna
            $table->string('no_ktp'); // Kolom untuk nomor KTP pengguna
            $table->string('no_hp'); // Kolom untuk nomor HP pengguna
            $table->string('no_rm')->nullable(); // Kolom untuk nomor rekam medis, nullable (opsional untuk pasien)
            $table->string('poli')->nullable(); // Kolom untuk poli, nullable (opsional untuk pasien)
            $table->string('email')->unique(); // Kolom email yang harus unik
            $table->timestamp('email_verified_at')->nullable(); // Kolom untuk tanggal verifikasi email, nullable
            $table->string('password'); // Kolom untuk password pengguna
            $table->rememberToken(); // Kolom untuk token "remember me" pada autentikasi
            $table->timestamps(); // Kolom untuk mencatat waktu pembuatan dan pembaruan
        });

        // Membuat tabel 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Kolom email sebagai primary key
            $table->string('token'); // Kolom untuk token reset password
            $table->timestamp('created_at')->nullable(); // Kolom untuk tanggal pembuatan token reset, nullable
        });

        // Membuat tabel 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Kolom ID untuk sesi, sebagai primary key
            $table->foreignId('user_id')->nullable()->index(); // Kolom user_id yang mengacu pada pengguna, nullable dan diindeks
            $table->string('ip_address', 45)->nullable(); // Kolom IP address untuk sesi, nullable (maksimal 45 karakter untuk IPv6)
            $table->text('user_agent')->nullable(); // Kolom user agent untuk sesi, nullable
            $table->longText('payload'); // Kolom payload untuk menyimpan data sesi
            $table->integer('last_activity')->index(); // Kolom untuk mencatat aktivitas terakhir dalam sesi, diindeks
        });
    }

    /**
     * Reverse the migrations.
     *
     * Fungsi ini digunakan untuk membalikkan/menghapus perubahan yang dilakukan di fungsi up().
     * Ini berguna jika kita ingin rollback migrasi.
     */
    public function down(): void
    {
        // Menghapus tabel 'users'
        Schema::dropIfExists('users');

        // Menghapus tabel 'password_reset_tokens'
        Schema::dropIfExists('password_reset_tokens');

        // Menghapus tabel 'sessions'
        Schema::dropIfExists('sessions');
    }
};
