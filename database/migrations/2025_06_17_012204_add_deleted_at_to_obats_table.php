<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToObatsTable extends Migration
{
    /**
     * Menjalankan migration untuk menambahkan kolom deleted_at.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->softDeletes(); // Menambahkan kolom deleted_at
        });
    }

    /**
     * Membalikkan perubahan yang dilakukan oleh migration ini.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Menghapus kolom deleted_at
        });
    }
}
