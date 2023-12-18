<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cashier>
 */
class CashierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::where('role', 'cashier')->pluck('user_id')->first();

        return [
            'cashier_id' => fake()->uuid,
            'user_id' => $user_id,
            'cashier_phone' => '08'.strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)),
            'cashier_gender' => Arr::random(['pria', 'wanita']),
            'cashier_address' => fake()->sentence(10),
        ];
    }
}
