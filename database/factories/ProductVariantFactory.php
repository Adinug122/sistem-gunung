<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'variant_name' => fake()->randomElement(['Size 38', 'Size 40', 'Size 42', 'M', 'L', 'XL', 'Biru', 'Hitam']),
            'sku' => fake()->unique()->bothify('VAR-####'),
            'stock' => fake()->numberBetween(1, 20),
            'price_per_day' => fake()->randomElement([null, 50000, 75000, 100000]),
        ];
    }
}
