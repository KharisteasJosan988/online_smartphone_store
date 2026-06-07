<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $android = Category::where('name', 'Android')->first();
        $ios = Category::where('name', 'IOS')->first();

        Product::insert([
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'description' => 'Flagship Samsung dengan Snapdragon 8 Gen 3.',
                'price' => 18999000,
                'stock' => 10,
                'merk' => 'Samsung',
                'color' => 'Titanium Gray',
                'storage' => '512GB',
                'image' => 'products/s24-ultra.jpg',
                'category_id' => $android->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Samsung Galaxy A55',
                'description' => 'Smartphone midrange Samsung.',
                'price' => 5999000,
                'stock' => 15,
                'merk' => 'Samsung',
                'color' => 'Awesome Navy',
                'storage' => '256GB',
                'image' => 'products/a55.jpg',
                'category_id' => $android->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Xiaomi 14',
                'description' => 'Flagship Xiaomi dengan Leica Camera.',
                'price' => 11999000,
                'stock' => 12,
                'merk' => 'Xiaomi',
                'color' => 'Black',
                'storage' => '512GB',
                'image' => 'products/xiaomi14.jpg',
                'category_id' => $android->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'OPPO Reno 12',
                'description' => 'Smartphone AI terbaru dari OPPO.',
                'price' => 6999000,
                'stock' => 20,
                'merk' => 'OPPO',
                'color' => 'Silver',
                'storage' => '256GB',
                'image' => 'products/reno12.jpg',
                'category_id' => $android->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'iPhone 15 Pro Max',
                'description' => 'iPhone flagship dengan chip A17 Pro.',
                'price' => 24999000,
                'stock' => 8,
                'merk' => 'Apple',
                'color' => 'Natural Titanium',
                'storage' => '256GB',
                'image' => 'products/iphone15pm.jpg',
                'category_id' => $ios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'iPhone 15',
                'description' => 'iPhone generasi terbaru.',
                'price' => 15999000,
                'stock' => 12,
                'merk' => 'Apple',
                'color' => 'Blue',
                'storage' => '128GB',
                'image' => 'products/iphone15.jpg',
                'category_id' => $ios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'iPhone 14',
                'description' => 'iPhone dengan performa tinggi.',
                'price' => 12999000,
                'stock' => 10,
                'merk' => 'Apple',
                'color' => 'Midnight',
                'storage' => '128GB',
                'image' => 'products/iphone14.jpg',
                'category_id' => $ios->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
