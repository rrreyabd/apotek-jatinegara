<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SellingInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellingInvoiceDetail>
 */
class SellingInvoiceDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $selling_id = SellingInvoice::pluck('selling_invoice_id')->all();
        $id = fake()->randomElement($selling_id);

        // $product_name = Product::pluck('product_name')->all();
        $products_name = Product::all()->pluck('product_name');
        $product_name = fake()->randomElement($products_name);

        return [
            'selling_detail_id' => fake()->uuid,
            'selling_invoice_id' => $id,
            'product_name' => $product_name,
            'product_sell_price' => Product::where('product_name', $product_name)->first()->product_sell_price,
            'quantity' => fake()->numberBetween(1, 20),
        ];
    }
}
