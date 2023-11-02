<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::where('role', 'user')->pluck('user_id')->all();
        $id = fake()->unique()->randomElement($user_id);

        return [
            'customer_id' => fake()->uuid,
            'user_id' => $id,
            'customer_phone' => '08'.strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)),
        ];
    }
}
