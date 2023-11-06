<?php

namespace Database\Factories;

use App\Models\Cashier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellingInvoice>
 */
class SellingInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'selling_invoice_id' => fake()->uuid,
            'cashier_name' => Cashier::first()->user->username,
            'customer_name' => fake()->words(2, true),
            'customer_phone' => '08'.strval(fake()->numberBetween(1000000000, 9999999999)),
            'customer_file'=> fake()->word().'.jpg',
            'customer_request' => fake()->words(10, true),
            'customer_bank' => fake()->word(),
            'customer_payment'=> fake()->word().'.jpg',
            'order_date' => fake()->dateTime(),
            'order_complete' => fake()->dateTime(),
            'refund_file' => fake()->word().'.jpg',
            'reject_comment' => fake()->words(15, true),
            'order_status' => fake()->randomElement(['Berhasil', 'Gagal', 'Menunggu Pengembalian', 'Menunggu Konfirmasi', 'Menunggu Pengambilan', 'Offline', 'Refund'])
        ];
    }
}
