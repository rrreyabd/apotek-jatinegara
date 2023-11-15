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
        \App\Models\User::factory()->create([
            'username' => 'winzliu'
        ]);

        \App\Models\Cashier::factory(1)->create();
        \App\Models\Customer::factory(8)->create();
        \App\Models\Category::factory(8)->create();
        \App\Models\Unit::factory(10)->create();
        \App\Models\Group::factory(4)->create();
        \App\Models\Supplier::factory(10)->create();
        for ($i=0; $i < 100; $i++) { 
            \App\Models\ProductDescription::factory(1)->create();
            \App\Models\Product::factory(1)->create();
            \App\Models\ProductDetail::factory(1)->create();
        }
        for ($i=0; $i < 40; $i++) { 
            \App\Models\SellingInvoice::factory(1)->create();
        }
        \App\Models\SellingInvoiceDetail::factory(150)->create();
        \App\Models\BuyingInvoice::factory(10)->create();
        \App\Models\BuyingInvoiceDetail::factory(40)->create();
        \App\Models\Information::factory(1)->create();
        \App\Models\Cart::factory(30)->create();
    }
}
