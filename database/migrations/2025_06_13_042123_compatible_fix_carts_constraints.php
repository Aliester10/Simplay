<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('carts')) {
            echo "Carts table doesn't exist, skipping...\n";
            return;
        }

        try {
            // Method 1: Try to drop foreign keys safely
            $this->dropForeignKeySafely('carts', 'carts_user_id_foreign');
            $this->dropForeignKeySafely('carts', 'carts_produk_id_foreign');
            
            // Method 2: Drop indexes safely
            $this->dropIndexSafely('carts', 'unique_user_product_cart');
            $this->dropIndexSafely('carts', 'unique_user_product');

            // Add foreign keys
            Schema::table('carts', function (Blueprint $table) {
                $table->foreign('user_id', 'carts_user_id_fk')
                      ->references('id')->on('users')
                      ->onDelete('cascade');
                      
                $table->foreign('produk_id', 'carts_produk_id_fk')
                      ->references('id')->on('produk')
                      ->onDelete('cascade');
                      
                $table->unique(['user_id', 'produk_id'], 'carts_user_produk_unique');
            });

            echo "Cart constraints added successfully!\n";

        } catch (\Exception $e) {
            echo "Info: " . $e->getMessage() . "\n";
            echo "Cart table constraints may already be in place.\n";
        }
    }

    public function down()
    {
        try {
            Schema::table('carts', function (Blueprint $table) {
                $table->dropForeign('carts_user_id_fk');
                $table->dropForeign('carts_produk_id_fk');
                $table->dropUnique('carts_user_produk_unique');
            });
        } catch (\Exception $e) {
            echo "Warning during rollback: " . $e->getMessage() . "\n";
        }
    }

    private function dropForeignKeySafely($table, $foreignKey)
    {
        try {
            // Check if foreign key exists
            $exists = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.TABLE_CONSTRAINTS 
                WHERE CONSTRAINT_SCHEMA = DATABASE() 
                AND TABLE_NAME = ? 
                AND CONSTRAINT_NAME = ? 
                AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            ", [$table, $foreignKey]);

            if (!empty($exists)) {
                DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$foreignKey}`");
                echo "Dropped foreign key: {$foreignKey}\n";
            }
        } catch (\Exception $e) {
            echo "Could not drop foreign key {$foreignKey}: " . $e->getMessage() . "\n";
        }
    }

    private function dropIndexSafely($table, $indexName)
    {
        try {
            $exists = DB::select("
                SELECT INDEX_NAME 
                FROM information_schema.STATISTICS 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = ? 
                AND INDEX_NAME = ?
            ", [$table, $indexName]);

            if (!empty($exists)) {
                DB::statement("ALTER TABLE `{$table}` DROP INDEX `{$indexName}`");
                echo "Dropped index: {$indexName}\n";
            }
        } catch (\Exception $e) {
            echo "Could not drop index {$indexName}: " . $e->getMessage() . "\n";
        }
    }
};