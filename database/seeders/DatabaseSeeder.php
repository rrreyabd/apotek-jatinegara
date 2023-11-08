<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(8)->create();
        \App\Models\User::factory()->create([
            'role' => 'cashier'
        ]);
        \App\Models\User::factory()->create([
            'role' => 'owner'
        ]);

        \App\Models\Cashier::factory(1)->create();
        \App\Models\Customer::factory(8)->create();
        \App\Models\Category::factory(8)->create();
        \App\Models\Unit::factory(10)->create();
        \App\Models\Group::factory(6)->create();
        \App\Models\Supplier::factory(10)->create();
        \App\Models\ProductDetail::factory(10)->create();
        for ($i=0; $i < 10; $i++) { 
            \App\Models\Product::factory(1)->create();
            \App\Models\SellingInvoice::factory(1)->create();
        }
        \App\Models\SellingInvoiceDetail::factory(40)->create();
        \App\Models\BuyingInvoice::factory(10)->create();
        \App\Models\BuyingInvoiceDetail::factory(40)->create();
        \App\Models\Information::factory(1)->create();
    }
}
