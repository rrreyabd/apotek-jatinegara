<?php

namespace Database\Factories;

use App\Models\BuyingInvoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BuyingInvoiceDetail>
 */
class BuyingInvoiceDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $buying_id = BuyingInvoice::pluck('buying_invoice_id')->all();
        $id = fake()->randomElement($buying_id);

        $products_name = Product::all()->pluck('product_name');
        $product_name = fake()->randomElement($products_name);

        return [
            'buying_detail_id' => fake()->uuid,
            'buying_invoice_id' => $id,
            'product_name' => $product_name,
            'product_buy_price' => fake()->numberBetween(1000,100000),
            'exp_date'=> fake()->dateTime(),
            'quantity' => fake()->numberBetween(1, 20),
        ];
    }
}
