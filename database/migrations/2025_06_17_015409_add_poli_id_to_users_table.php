<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoliIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Menambahkan kolom 'poli_id' pada tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('poli_id')->nullable()->constrained('polis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Menghapus kolom 'poli_id' dari tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('poli_id');
        });
    }
}
