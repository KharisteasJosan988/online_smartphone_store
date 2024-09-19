<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'merk' => $this->faker->company(),
            'color' => $this->faker->colorName(),
            'storage' => $this->faker->randomElement(['64GB', '128GB', '256GB']),
            'image' => $this->faker->imageUrl(640, 480, 'smartphone'),
            'category_id' => Category::factory(), // Mengambil category dari CategoryFactory
        ];
    }
}
