<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products_id = Product::all()->pluck('product_id');
        $product_id = fake()->unique()->randomElement($products_id);

        $stock = rand(1,50);

        return [
            'detail_id' => fake()->uuid,
            'product_id' => $product_id,
            'product_expired'=> fake()->dateTime(),
            'product_stock' => $stock,
            'product_buy_price' => fake()->numberBetween(1000,100000),
        ];
    }
}
