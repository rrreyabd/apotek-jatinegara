<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDetail;
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
        $produk_id = Product::orderBy('product_id', 'desc')->pluck('product_id')->first();
        $number = intval(str_replace("P-", "", $produk_id)) + 1;

        $details_id = ProductDetail::pluck('detail_id')->all();
        $detail_id = fake()->unique()->randomElement($details_id);

        $stock = rand(0,50);

        return [
            'id' => fake()->uuid,
            'product_id' => 'P-'. str_pad($number, 6, '0', STR_PAD_LEFT),
            'detail_id' => $detail_id,
            'product_name' => fake()->words(5, true),
            'product_expired'=> fake()->dateTime(),
            'product_stock' => $stock,
            'product_buy_price' => 12000,
            'product_sell_price' => 15000,
            'product_status'=> $stock == 0 ? 'tidak aktif' : 'aktif',
        ];
    }
}
