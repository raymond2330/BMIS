<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Resident;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use PDF;


class FormTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_forms_menu()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('certificates/index');
        $response->assertStatus(200);
    }
    public function test_good_moral()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('forms/goodmoral');
        $response->assertStatus(200);
    }
    public function test_legal_guardian()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('forms/legal_guardian');
        $response->assertStatus(200);
    }
    public function test_certification()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('forms/certification');
        $response->assertStatus(200);
    }
    public function test_indigency()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('forms/indigency');
        $response->assertStatus(200);
    }
    public function test_log_form_request()
    {
        $this->faker = Faker::create();
        $response = DB::table('certificates')->insert([

            'form' => $this->faker->randomElement([
                "Indigency",
                "Legal Guardian",
                "Certification",
            ]),
            'requester' => $this->faker->name()
        ]);
        $this->assertTrue($response);
    }
}
