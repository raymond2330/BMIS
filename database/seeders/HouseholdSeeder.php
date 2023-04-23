<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Household;
use Illuminate\Support\Facades\DB;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        foreach (range(1, 850) as $household) {
            $street_id = $this->faker->numberBetween($min = 1, $max = 8);
            $household = Household::create([
                'street_id' =>  $street_id,
                'edifice_number' =>  $this->faker->numberBetween($min = 0, $max = 900),
                'postal_code' => '1001',
                'city' => 'Quiapo, Manila',
                'household_size' => 0,
                'number_family' =>  0,
                'income' => 0,
                'income_classification' => "",
                'waste_management' => $this->faker->randomElement(["Incineration", "Composting", "Recycled", "Others"]),
                'toilet' => $this->faker->randomElement(["Pail type", "Water-sealed/Flushed", "Others", "No toilet facility"]),
                'dwelling_type' => $this->faker->randomElement(["Concrete", "Semi-concrete", "Log/Wood", "Others"]),
                'ownership' => $this->faker->randomElement(["Rented", "Owned", "Shared with owner", "Shared with renter", "Informal settler"]),
            ]);
            DB::table('streets')->where('id', $street_id)->increment('household_count', 1);
        }
    }
}
