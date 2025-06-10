<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Household>
 */
class HouseholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street_id' =>  $this->faker->numberBetween($min = 1, $max = 4),
            'edifice_number' =>  $this->faker->numberBetween($min = 0, $max = 900),
            'postal_code' => '1001',
            'city' => 'Quiapo, Manila',
            'household_size' => 0,
            'number_family' =>  0,
            'income' => 0,
            'income_classification' => $this->faker->randomElement([
                "Poor",
                "Low income",
                "Lower middle class",
                "Middle class",
                "Upper middle class",
                "High income",
                "Rich",
            ]),
            'waste_management' => $this->faker->randomElement(["Incineration", "Composting", "Recycled", "Others"]),
            'toilet' => $this->faker->randomElement(["Pail type", "Water-sealed/Flushed", "Others", "No toilet facility"]),
            'dwelling_type' => $this->faker->randomElement(["Concrete", "Semi-concrete", "Log/Wood", "Others"]),
            'ownership' => $this->faker->randomElement(["Rented", "Owned", "Shared with owner", "Shared with renter", "Informal settler"]),
        ];
    }
}
