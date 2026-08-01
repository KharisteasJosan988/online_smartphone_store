<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('destination_province_id')
                ->nullable()
                ->after('alamat_pengiriman');

            $table->unsignedBigInteger('destination_city_id')
                ->nullable()
                ->after('destination_province_id');

            $table->unsignedBigInteger('destination_district_id')
                ->nullable()
                ->after('destination_city_id');

            $table->string('shipping_courier_code')
                ->nullable()
                ->after('shipping_cost');

            $table->string('shipping_service')
                ->nullable()
                ->after('shipping_courier_code');

            $table->string('shipping_description')
                ->nullable()
                ->after('shipping_service');

            $table->string('shipping_etd')
                ->nullable()
                ->after('shipping_description');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'destination_province_id',
                'destination_city_id',
                'destination_district_id',
                'shipping_courier_code',
                'shipping_service',
                'shipping_description',
                'shipping_etd',
            ]);
        });
    }
};
