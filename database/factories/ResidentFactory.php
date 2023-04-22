<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'household_id' =>  $this->faker->numberBetween($min = 1, $max = 850),
            'surname' => $this->faker->lastName($gender = null),
            'given_name' => $this->faker->firstName($gender = null),
            'middle_name' => $this->faker->lastName($gender = null),
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'age' => $this->faker->numberBetween($min = 0, $max = 90),
            'sex' => $this->faker->randomElement(["Male", "Female"]),
            'religion' => $this->faker->randomElement(["Catholic", "INC", "Others"]),
            'civil_status' => $this->faker->randomElement(["Single", "Married", "Separated", "Annulled", "Widowed"]),
            'nationality' =>  $this->faker->randomElement(["Filipino", "Spanish", "Chinese"]),
            'contact' => $this->faker->numerify('09#########'),
            'household_head' => $this->faker->randomElement(["Yes", "No"]),
            'bona_fide' => $this->faker->randomElement(["Yes", "No"]),
            'resident_six_months' => $this->faker->randomElement(["Yes", "No"]),
            'solo_parent' => $this->faker->randomElement(["Yes", "No"]),
            'voter' => $this->faker->randomElement(["Yes", "No"]),
            'pwd' => $this->faker->randomElement(["No"]),
            'is_studying' => $this->faker->randomElement(["Yes", "No"]),
            'education' => $this->faker->randomElement([
                "No grade completed",
                "Elementary undergraduate",
                "Elementary graduate",
                "High school undergraduate",
                "High school graduate",
                "Post secondary undergraduate",
                "Post secondary graduate",
                "College undergraduate",
                "College graduate",
                "Post baccalaureate"
            ]),
            'institution' => $this->faker->company,
            'graduate_year' => $this->faker->date($format = 'Y-m'),
            'specialization' => $this->faker->jobTitle,
            'is_employed' => $this->faker->randomElement(["Yes", "No"]),
            'job_title' => $this->faker->randomElement([
                "Manual Laborer",
                "Doctor/Lawyer/Professionals",
                "Government employee",
                "Private employee",
                "Pro-driver",
                "Non pro-driver",
                "Househelper",
                "Lending",
                "Vendor/Sales worker",
                "Skilled agricultural forestry and fishery workers",
                "Others"
            ]),
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
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null)
        ];
    }
}
