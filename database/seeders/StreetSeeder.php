<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Street;
use App\Models\Household;



class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $streets = array("Arlegui", "Duque de Alba", "Castillejos", "Vergara", "Fraternal", "P. Casal", "Pax", "Farnecio");        
        foreach($streets as $street) {
            Street::create([
                'street' => $street,
                'street_image' => $street.'.png',
                // 'household_count' => $this->faker->numberBetween($min = 90, $max = 120),
                'household_count' => 0
            ]);
        }
    }
}
