<?php

namespace Database\Factories;

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

        return [
            'selling_detail_id' => fake()->uuid,
            'selling_invoice_id' => $id,
            'product_name' => fake()->words(2,true),
            'product_sell_price' => fake()->numberBetween(1000,1000000),
            'quantity' => fake()->numberBetween(1, 100),
        ];
    }
}
