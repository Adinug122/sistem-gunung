<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'rental_id' => Rental::factory(),
            'content' => fake()->paragraphs(2, true),
            'rating' => fake()->numberBetween(1, 5),
            'is_approved' => fake()->boolean(),
        ];
    }
}
