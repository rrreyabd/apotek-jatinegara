<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users_id = User::where('role', 'user')->pluck('user_id')->all();
        $user_id = fake()->randomElement($users_id);
        
        $products_id = Product::pluck('product_id')->all();
        $product_id = fake()->randomElement($products_id);

        return [
            'cart_id' => fake()->uuid,
            'user_id' => $user_id,
            'product_id'=> $product_id,
            'quantity'=> mt_rand(1,10),
        ];
    }
}
