<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaymentProofPathColumnsFromProformaInvoices extends Migration

{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            // Hapus kolom payment_proof_path, second_payment_proof_path, dan payment_proof_amounts
            $table->dropColumn(['payment_proof_path', 'second_payment_proof_path']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            // Tambahkan kembali kolom yang dihapus jika rollback dilakukan
            $table->string('payment_proof_path')->nullable();
            $table->string('second_payment_proof_path')->nullable();
            $table->json('payment_proof_amounts')->nullable();
        });
    }
};
