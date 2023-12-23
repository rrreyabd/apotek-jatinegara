<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Information>
 */
class InformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'information_id' => fake()->uuid,
            'apotic_name'=> 'Apotik Jati Negara',
            'apotic_web_name' => 'www.ApotikJatiNegara.com',
            'SIA_number' => '0321/SK-ADP/SPMTPSP/JKT/3.2/IX/2024',
            'SIPA_number'=> '3152/SDP/DAMTSPU/JKT/3.1/IX/2024',
            'apotic_owner'=> 'apt. Lala Musana, S.Si.',
            'apotic_address'=> 'Jl. Suka Lama No.29, Jakarta',
            'monday_schedule'=> '09.00 - 20.00',
            'tuesday_schedule'=> '09.00 - 20.00',
            'wednesday_schedule'=> '09.00 - 20.00',
            'thursday_schedule'=> '09.00 - 20.00',
            'friday_schedule'=> '09.00 - 20.00',
            'saturday_schedule'=> '09.00 - 20.00',
            'sunday_schedule'=> '13.30 - 20.00',
        ];
    }
}
