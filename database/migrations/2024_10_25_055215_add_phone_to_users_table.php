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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15)->nullable()->after('email'); // menambahkan kolom 'phone'
            $table->text('address')->nullable()->after('phone'); // menambahkan kolom 'address'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone'); // menghapus kolom 'phone' saat rollback
            $table->dropColumn('address');
        });
    }
};
