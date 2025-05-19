<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->integer('installments')->after('dp'); // Adjust placement as needed
        });
    }

    public function down()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->dropColumn('installments');
        });
    }
};
