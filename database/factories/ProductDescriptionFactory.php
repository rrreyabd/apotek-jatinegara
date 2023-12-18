<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Group;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDescription>
 */
class ProductDescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories_id = Category::all()->pluck('category_id');
        $category_id = fake()->randomElement($categories_id);

        $units_id = Unit::all()->pluck('unit_id');
        $unit_id = fake()->randomElement($units_id);

        $groups_id = Group::all()->pluck('group_id');
        $group_id = fake()->randomElement($groups_id);

        $suppliers_id = Supplier::all()->pluck('supplier_id');
        $supplier_id = fake()->randomElement($suppliers_id);

        return [
            'description_id' => fake()->uuid,
            'category_id' => $category_id,
            'unit_id' => $unit_id,
            'group_id' => $group_id,
            'supplier_id' => $supplier_id,
            'product_type' => fake()->randomElement(['umum', 'resep dokter']),
            'product_manufacture' => fake()->words(5, true),
            'product_DPN' => 'DKL'. fake()->numberBetween(100000000,999999999) .'A21',
            'product_sideEffect' => fake()->sentences(6, true),
            'product_description' => fake()->sentences(6, true),
            'product_dosage' => fake()->sentences(6, true),
            'product_indication' => fake()->sentences(fake()->randomElement([0,6]), true),
            'product_notice' => fake()->sentences(fake()->randomElement([0,6]), true),
        ];
    }
}
