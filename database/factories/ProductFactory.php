<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(7), // Angka hingga 7 digit (misal: 1.234.567)
            'stock' => $this->faker->numberBetween(1, 100),
            'category' => $this->faker->randomElement(['Lemari', 'Meja', 'Kursi']),
            'image' => $this->faker->imageUrl(),
            'estimated_days' => $this->faker->numberBetween(5, 60), //estimasi waktu
        ];
    }
}
