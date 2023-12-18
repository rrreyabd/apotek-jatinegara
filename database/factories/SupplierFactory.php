<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supplier = ['Antarmitra Sembada','Bina San Prima', 'Global Mitra Prima','Mekada Abadi', 'Menara Abadi Sentosa','Mensa Binasukses','Merapi Utama'];
        $supplier_address = [
            'Jl. Asoka No. 95/97 Kelurahan Asam Kumbang, Kecamatan Medan 20122', 
            'Jl. Gatot Subroto KM 5,5 No. 210AB Kel. Sei Sikambing CII Kec. Medan Helvetia 20123',
            'Jl. Budi Luhur No. 196 Medan - 20123',
            'Jl. Kapten Muslim No.235, Helvetia Tengah, Kec. Medan Helvetia, Kota Medan, Sumatera Utara 20124', 
            'Jl. Pancing No.20, Kenangan Baru, Kec. Percut Sei Tuan, Medan, Sumatera Utara 20371',
            'Jl. Tempua No.36, Sei Sikambing B, Kec. Medan Sunggal, Kota Medan, Sumatera Utara 20122',
            'Jl. Tapian Nauli, Pasar 1 No. 5, Sunggal, Kec. Medan Sunggal, Kota Medan, Sumatera Utara 20133', 
            ];
        $supplier_phone = ['(061)80015580','(061)8443113','(061)8444555','(061)8471900','(061)7332182', '(061)42008266','(061)8449505'];

        static $counter = 0;

        $data = [
            'supplier_id' => fake()->uuid,
            'supplier' => $supplier[$counter],
            'supplier_address' => $supplier_address[$counter],
            'supplier_phone' => $supplier_phone[$counter],
        ];
    
        $counter++;
    
        return $data;
    }
}






