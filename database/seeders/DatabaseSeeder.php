<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed random users
        User::factory(10)->create();

        // Create a specific user or avoid duplication using firstOrCreate
        User::firstOrCreate(
            ['email' => 'test@example.com'], // Check if the email already exists
            [
                'name' => 'Test User',
                'password' => bcrypt('test@example.com'), // Hash the password
            ]
        );

        // Seed categories
        $categories = Category::factory(5)->create();

        // Seed products with category_id
        Product::factory(20)->create();
    }
}
