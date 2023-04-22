<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'form' => $this->faker->randomElement([
                "Indigency",
                "Certification",
                "Legal Guardian",
                "Solo Parent",
                "Residency",
                "Good Moral"
            ]),
            'requester' => $this->faker->name(), 
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null)
        ];
    }
}
