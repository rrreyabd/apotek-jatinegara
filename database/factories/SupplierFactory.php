<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => fake()->uuid,
            'supplier' => 'PT. '.fake()->unique()->words(4, true),
            'supplier_address' => fake()->words(18, true),
            'supplier_phone' => '08'.strval(fake()->numberBetween(1000000000, 9999999999)),
        ];
    }
}
