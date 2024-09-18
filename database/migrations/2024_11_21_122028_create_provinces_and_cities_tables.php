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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id(); // ID dari API RajaOngkir
            $table->string('province'); // Nama provinsi
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id(); // ID dari API RajaOngkir
            $table->string('city_name'); // Nama kota
            $table->string('type'); // Jenis (Kabupaten/Kota)
            $table->unsignedBigInteger('province_id'); // Sesuaikan tipe datanya
            $table->foreign('province_id')->references('id')->on('provinces')->cascadeOnDelete(); // Foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces_and_cities_tables');
    }
};
