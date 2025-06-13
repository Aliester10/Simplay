<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payment_statuses', function (Blueprint $table) {
            // Change enum to include 'uploaded' status
            $table->enum('status', ['pending', 'uploaded', 'approved', 'rejected'])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('payment_statuses', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->change();
        });
    }
};