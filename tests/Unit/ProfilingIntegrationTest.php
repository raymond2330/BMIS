<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use App\Models\Household;
use App\Models\Resident;
use App\Models\User;
use App\Models\Street;


class ProfilingIntegrationTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

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
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_open_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function test_login()
    {
        $response = $this->post('/login', [
            'email' => 'secretary@server.com',
            'password' => 'secretary'
        ]);
        $response->assertRedirect('/');
    }
    public function test_can_open_streets_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/streets/index');
        $response->assertStatus(200);
    }
    public function test_can_create_household_and_add_resident()
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
            'income_classification' => 'Middle class'
        ];
        $response = $this->actingAs($this->user)->post(route('households.store'), $household);

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
        $response = $this->actingAs($this->user)->post(route('residents.store'), $resident);

        $household = Household::first();
        $household->refresh();
        $this->assertEquals(50000, $household->income);

        if ($household->income <= 10957) {
            $income_classification = "Poor";
        } elseif ($household->income > 10957 && $household->income <= 21194) {
            $income_classification = "Low income";
        } elseif ($household->income > 21194 && $household->income <= 43828) {
            $income_classification = "Lower middle class";
        } elseif ($household->income > 43828 && $household->income <= 76669) {
            $income_classification = "Middle class";
        } elseif ($household->income > 76670 && $household->income <= 131484) {
            $income_classification = "Upper middle class";
        } elseif ($household->income > 131484 && $household->income <= 219140) {
            $income_classification = "High income";
        } elseif ($household->income > 219140) {
            $income_classification = "Rich";
        } else {
            $income_classification = "No data";
        }
        $this->assertEquals('Middle class', $household->income_classification);
        $this->assertEquals(1, $household->household_size);
    }
    public function test_only_bonafide_residents_are_allowed_to_be_selected()
    {
        $response = $this->get('forms/certification');
        $response->assertStatus(302);
        // $response->assertViewHas('residents');

    }
}
