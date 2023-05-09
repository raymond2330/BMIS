<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use App\Models\Household;
use App\Models\Resident;
use App\Models\User;
use App\Models\Street;


class ResidentTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'secretary account',
            'email' => 'secretary@server.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'user_type' => 0
        ]);

        $this->actingAs($this->user);
    }
    /**
     * @group resident
     */
    public function test_resident_profile_updates_household_profile()
    {
        $street = Street::factory()->create([
            'street' => 'Arlegui',
            'street_image' => 'Arlegui.png'
        ]);

        $household = [
            'id' => 1,
            'street_id' => Crypt::encryptString($street->id),
            'edifice_number' => '123',
            'waste_management' => 'Incineration',
            'toilet' => 'Pail type',
            'dwelling_type' => 'Concrete',
            'ownership' => 'Rented',
            'household_size' => 0,
            'number_family' => 0,
            'income' => 25000,
            'income_classification' => 'Lower middle class'
        ];
        $response = $this->post(route('households.store'), $household);

        $this->assertDatabaseHas('households', [
            'edifice_number' => $household['edifice_number'],
            'postal_code' => '1001',
            'city' => 'Quiapo, Manila',
            'household_size' => 0,
            'income' => 25000,
            'income_classification' => 'Lower middle class',
            'waste_management' => $household['waste_management'],
            'toilet' => $household['toilet'],
            'dwelling_type' => $household['dwelling_type'],
            'ownership' => $household['ownership']
        ]);



        $this->assertEquals(1, $street->fresh()->household_count);

        $resident = [
            'household_id' => Crypt::encryptString($household['id']),
            'surname' => 'Flores',
            'given_name' => 'Jann Marcus',
            'middle_name' => 'Madrigal',
            'birth_date' => '07/19/2001',
            'age' => '21',
            'sex' => 'Male',
            'pregnant' => 'No',
            'religion' => 'Catholic',
            'civil_status' => 'Single',
            'nationality' => 'Filipino',
            'contact' => '09617343130',
            'household_head' => 'Yes',
            'bona_fide' => 'Yes',
            'resident_six_months' => 'Yes',
            'solo_parent' => 'No',
            'voter' => 'Yes',
            'pwd' => 'No',
            'disability' => '',
            'is_studying' => 'No',
            'education' => 'College graduate',
            'institution' => '',
            'graduate_year' => '',
            'specialization' => '',
            'is_employed' => 'No',
            'job_title' => 'Others',
            'income' => 25000,
        ];

        $response = $this->post(route('residents.store'), $resident);

        $household = Household::first();
        $household->refresh();
        $this->assertEquals(50000, $household->income);
        $this->assertEquals('Middle class', $household->income_classification);
        $this->assertEquals(1, $household->household_size);
    }
}
