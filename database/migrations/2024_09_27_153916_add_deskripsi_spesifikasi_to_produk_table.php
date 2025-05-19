<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsiSpesifikasiToProdukTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Menambahkan kolom link jika belum ada
            if (!Schema::hasColumn('produk', 'link')) {
                $table->string('link')->nullable()->after('id'); // Ganti 'id' dengan nama kolom terakhir yang ada
            }

            // Menambahkan kolom spesifikasi jika belum ada
            if (!Schema::hasColumn('produk', 'spesifikasi')) {
                $table->text('spesifikasi')->nullable()->after('deskripsi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'spesifikasi']);
            $table->dropColumn('link');
        });
    }
}
