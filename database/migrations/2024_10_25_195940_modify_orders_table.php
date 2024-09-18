<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mengubah kolom status menjadi enum dengan beberapa nilai
            $table->enum('status', ['pending', 'processed', 'shipped', 'delivered', 'cancelled'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mengembalikan status ke tipe string jika rollback
            $table->string('status')->default('pending')->change();
        });
    }
};
