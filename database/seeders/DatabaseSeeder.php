<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin@example.com'),
                'role' => 'admin',
                'is_admin' => 1,
            ]
        );

        // Customer Demo
        User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer Demo',
                'password' => Hash::make('customer@example.com'),
                'role' => 'customer',
                'is_admin' => 0,
            ]
        );

        // Kategori Android
        Category::firstOrCreate(
            ['name' => 'Android'],
            [
                'description' => 'Android merupakan sistem operasi mobile berbasis Linux yang dikembangkan oleh Google. Android diperkenalkan secara resmi pada tahun 2007 dan mulai dikenal luas sejak perangkat Android dipasarkan pada tahun 2008. Sistem operasi ini menyediakan berbagai layanan dan aplikasi melalui Google Play Store yang memungkinkan pengguna mengunduh aplikasi, game, dan berbagai kebutuhan lainnya.'
            ]
        );

        // Kategori IOS
        Category::firstOrCreate(
            ['name' => 'IOS'],
            [
                'description' => 'iOS merupakan sistem operasi mobile yang dikembangkan oleh Apple khusus untuk perangkat seperti iPhone. Sistem operasi ini pertama kali diperkenalkan pada tahun 2007 bersamaan dengan peluncuran iPhone generasi pertama. iOS menyediakan layanan distribusi aplikasi melalui App Store yang memungkinkan pengguna mengunduh aplikasi, game, serta berbagai layanan digital dengan tingkat keamanan dan integrasi yang tinggi.'
            ]
        );

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
