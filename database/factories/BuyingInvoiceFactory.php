<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BuyingInvoice>
 */
class BuyingInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $suppliers = Supplier::all();
        $supplier = $suppliers->random(1)->first()->supplier;

        return [
            'buying_invoice_id' => fake()->uuid,
            'order_date'=> fake()->dateTimeBetween('-7 year', 'now'),
            'supplier_name'=> $supplier,
        ];
    }
}
