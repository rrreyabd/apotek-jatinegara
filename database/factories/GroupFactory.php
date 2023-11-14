<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groups = ['Bebas', 'Bebas Terbatas', 'Keras', 'Narkotika'];

        return [
            'group_id' => fake()->unique()->uuid,
            'group' => fake()->unique()->randomElement($groups),
        ];
    }
}
