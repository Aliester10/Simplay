<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSpesifikasiFromProdukTable extends Migration
{
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('spesifikasi'); // Menghapus kolom 'spesifikasi'
        });
    }

    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->text('spesifikasi')->nullable(); // Kembalikan kolom 'spesifikasi' jika rollback
        });
    }
}
