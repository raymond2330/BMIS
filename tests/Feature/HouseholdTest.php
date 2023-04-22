<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Street;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class HouseholdTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_streets()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('streets/index');
        $response->assertStatus(200);
    }
    public function test_show_households_in_a_street()
    {
        $households = Street::find(1)->households()->orderBy('edifice_number')->get();
        if ($households) {
            $this->assertTrue(true);
        }
    }
    public function test_household_created_or_updated()
    {
        $this->faker = Faker::create();
        $response = DB::table('households')->updateOrInsert([
            'edifice_number' => '123',
            'street_id' => $this->faker->numberBetween(1, 8),
            'postal_code' => '1001',
            'city' => 'Quiapo, Manila',
            'household_size' => 0,
            'number_family' => 0,
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
        ]);
        $this->assertTrue($response);
    }
    public function test_view_household()
    {
        $household = Household::first();
        if ($household) {
            $this->assertTrue(true);
        }
    }
    public function test_show_residents_in_a_household()
    {
        $residents = Household::find(1)->residents()->orderBy('age')->get();
        if ($residents) {
            $this->assertTrue(true);
        }
    }
    public function test_resident_created_or_updated()
    {
        $this->faker = Faker::create();
        $response = DB::table('residents')->updateOrInsert([
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
        ]);
        $this->assertTrue($response);
    }
}
