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
            'SIA_number' => '0126/SK-APT/DPMPTSP/MDN/3.3/VIII/2021',
            'SIPA_number'=> '3150/SIP/DPMPTSP/MDN/3.1/VII/2021',
            'apotic_owner'=> 'apt. Sasmita irawati, S.Si.',
            'apotic_address'=> 'Jl. Prof. H. M Yamin No 134 Medan',
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
