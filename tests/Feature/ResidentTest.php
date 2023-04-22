<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Household;
use App\Models\Resident;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ResidentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_resident()
    {
        $user = User::find(1); //user id 1 is the admin account
        $address = Household::first();
        $response = $this->actingAs($user)
            ->get('households/create_resident/' . $address->id);
        $response->assertStatus(200);
    }
    public function test_resident_created_or_updated()
    {
        $this->faker = Faker::create();
        $response = DB::table('residents')->updateOrInsert([
            'full_address' =>  $this->faker->randomElement([
                "123 Arlegui Street, Barangay 385, 1001 Quiapo, Manila, Philippines",
            ]),
            'surname' => $this->faker->lastName($gender = null),
            'given_name' => $this->faker->firstName($gender = null),
            'middle_name' => $this->faker->lastName($gender = null),
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'age' => $this->faker->numberBetween($min = 0, $max = 90),
            'sex' => $this->faker->randomElement(["Male", "Female"]),
            'civil_status' => $this->faker->randomElement(["Single", "Married", "Separated", "Annulled", "Widowed"]),
            'nationality' =>  $this->faker->randomElement(["Filipino", "Spanish", "Chinese"]),
            'contact' => $this->faker->phoneNumber,
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
            'job_title' => $this->faker->randomElement(["Managers", "Professionals", "Technicians and associate professionals", "Clerical support workers", "Service and sales workers", "Skilled agricultural, forestry and fishery workers", "Craft and related trades workers", "Plant and machine operators and assemblers", "Elementary occupations", "Armed forces occupations"]),
            'income' => 0,
            'income_range' => $this->faker->randomElement([
                "Less than or equal to P10,957",
            ]),
            'income_classification' => $this->faker->randomElement([
                "Poor",
            ]),
        ]);
        $this->assertTrue($response);
    }
    public function test_view_residents_in_household()
    {
        $user = User::find(1); //user id 1 is the admin account
        $address = Household::first();
        $response = $this->actingAs($user)
            ->get('households/residents/' . $address->full_address);
        $response->assertStatus(200);
    }
    public function test_household_deleted()
    {
        $household = Household::first();
        if ($household) {
            $household->delete();
        }
        $this->assertTrue(true);
    }
    public function test_resident_deleted()
    {
        $resident = Resident::first();
        if ($resident) {
            $resident->delete();
        }
        $this->assertTrue(true);
    }
}
