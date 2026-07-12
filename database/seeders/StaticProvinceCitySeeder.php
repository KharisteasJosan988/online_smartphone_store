<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticProvinceCitySeeder extends Seeder
{
    /**
     * Seed data provinsi & kota secara statis (bukan dari API RajaOngkir).
     *
     * Dipakai sebagai pengganti ProvinceCitySeeder untuk keperluan demo/portofolio,
     * karena RajaOngkir API V1 (yang dipakai kode ini) sudah deprecated dan
     * API V2 dari Komerce punya struktur data yang berbeda (district-based,
     * bukan city-based) sehingga tidak kompatibel tanpa refactor besar.
     *
     * Fitur kalkulasi ongkir di app ini juga sudah di-hardcode oleh developer
     * aslinya (lihat OrderController::calculateShipping), jadi data kota di
     * bawah ini hanya perlu cukup untuk mengisi dropdown checkout, tidak perlu
     * akurat 100% secara live.
     */
    public function run(): void
    {
        $data = [
            'DKI Jakarta' => [
                ['name' => 'Jakarta Pusat', 'type' => 'Kota'],
                ['name' => 'Jakarta Selatan', 'type' => 'Kota'],
                ['name' => 'Jakarta Barat', 'type' => 'Kota'],
                ['name' => 'Jakarta Timur', 'type' => 'Kota'],
                ['name' => 'Jakarta Utara', 'type' => 'Kota'],
            ],
            'Jawa Barat' => [
                ['name' => 'Bandung', 'type' => 'Kota'],
                ['name' => 'Bekasi', 'type' => 'Kota'],
                ['name' => 'Bogor', 'type' => 'Kota'],
                ['name' => 'Depok', 'type' => 'Kota'],
            ],
            'Jawa Tengah' => [
                ['name' => 'Semarang', 'type' => 'Kota'],
                ['name' => 'Surakarta', 'type' => 'Kota'],
                ['name' => 'Magelang', 'type' => 'Kota'],
            ],
            'Daerah Istimewa Yogyakarta' => [
                ['name' => 'Yogyakarta', 'type' => 'Kota'],
                ['name' => 'Sleman', 'type' => 'Kabupaten'],
                ['name' => 'Bantul', 'type' => 'Kabupaten'],
                ['name' => 'Gunung Kidul', 'type' => 'Kabupaten'],
            ],
            'Jawa Timur' => [
                ['name' => 'Surabaya', 'type' => 'Kota'],
                ['name' => 'Malang', 'type' => 'Kota'],
                ['name' => 'Sidoarjo', 'type' => 'Kabupaten'],
            ],
            'Bali' => [
                ['name' => 'Denpasar', 'type' => 'Kota'],
                ['name' => 'Badung', 'type' => 'Kabupaten'],
            ],
            'Sumatera Utara' => [
                ['name' => 'Medan', 'type' => 'Kota'],
            ],
            'Sulawesi Selatan' => [
                ['name' => 'Makassar', 'type' => 'Kota'],
            ],
        ];

        foreach ($data as $provinceName => $cities) {
            $provinceId = DB::table('provinces')->updateOrInsert(
                ['province' => $provinceName],
                ['updated_at' => now(), 'created_at' => now()]
            );

            $province = DB::table('provinces')->where('province', $provinceName)->first();

            foreach ($cities as $city) {
                DB::table('cities')->updateOrInsert(
                    [
                        'city_name' => $city['name'],
                        'province_id' => $province->id,
                    ],
                    [
                        'type' => $city['type'],
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }
    }
}
