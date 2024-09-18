<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data provinsi dari API
        $responseProvince = Http::withHeaders(['key' => env('RAJAONGKIR_API_KEY')])
            ->get(env('RAJAONGKIR_BASEURL') . '/province');

        if ($responseProvince->successful()) {
            $provinces = $responseProvince->json()['rajaongkir']['results'];
            foreach ($provinces as $province) {
                \DB::table('provinces')->updateOrInsert([
                    'id' => $province['province_id'],
                ], [
                    'province' => $province['province'],
                ]);
            }
        }

        // Ambil data kota dari API
        $responseCity = Http::withHeaders(['key' => env('RAJAONGKIR_API_KEY')])
            ->get(env('RAJAONGKIR_BASEURL') . '/city');

        if ($responseCity->successful()) {
            $cities = $responseCity->json()['rajaongkir']['results'];
            foreach ($cities as $city) {
                \DB::table('cities')->updateOrInsert([
                    'id' => $city['city_id'],
                ], [
                    'city_name' => $city['city_name'],
                    'type' => $city['type'],
                    'province_id' => $city['province_id'],
                ]);
            }
        }
    }
}
