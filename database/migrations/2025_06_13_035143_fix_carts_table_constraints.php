<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Drop existing foreign key if exists
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
            
            // Add proper foreign key constraints
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Add unique constraint to prevent duplicate cart items
            $table->unique(['user_id', 'produk_id'], 'unique_user_product_cart');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->dropForeign(['user_id']);
            $table->dropUnique('unique_user_product_cart');
        });
    }
};