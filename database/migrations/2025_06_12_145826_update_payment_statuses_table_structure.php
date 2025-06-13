<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop jika table sudah ada dan buat ulang dengan struktur yang benar
        Schema::dropIfExists('payment_statuses');
        
        Schema::create('payment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->decimal('amount', 15, 2);
            $table->enum('payment_method', ['bank_transfer', 'qris', 'other'])->default('qris');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('payment_proof')->nullable(); // File path untuk bukti pembayaran
            $table->text('admin_notes')->nullable(); // Catatan dari admin
            $table->text('reject_reason')->nullable(); // Alasan penolakan
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable(); // Admin yang approve
            
            // Relasi dengan order yang sudah ada
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_statuses');
    }
};