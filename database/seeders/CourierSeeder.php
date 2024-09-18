<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couriers = [
            ['code' => 'jne', 'name' => 'Jalur Nugraha Ekakurir (JNE)', 'is_active' => true],
            ['code' => 'pos', 'name' => 'POS Indonesia', 'is_active' => true],
            ['code' => 'tiki', 'name' => 'Citra Van Titipan Kilat (TIKI)', 'is_active' => true],
            // Tambahkan kurir lainnya jika diperlukan
        ];

        foreach ($couriers as $courier) {
            Courier::updateOrCreate(
                ['code' => $courier['code']],
                ['name' => $courier['name'], 'is_active' => $courier['is_active']]
            );
        }
    }
}
