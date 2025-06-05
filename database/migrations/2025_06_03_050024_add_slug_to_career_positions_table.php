<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_positions', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('application_deadline');
        });
    }

    public function down(): void
    {
        Schema::table('career_positions', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};