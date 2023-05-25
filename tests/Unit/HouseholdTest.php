<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use App\Models\Household;
use App\Models\Resident;
use App\Models\User;
use App\Models\Street;





class HouseholdTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
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

        $this->actingAs($this->user);
    }
    public function test_invalid_user_type_cannot_store_household_record()
    {
        $response = $this->post(route('households.store'));
        $response->assertRedirect('/');
    }
    public function test_household_can_be_stored_and_household_count_is_incremented()
    {
        $street = Street::factory()->create([
            'street' => 'Arlegui',
            'street_image' => 'Arlegui.png'
        ]);
        $household = [
            'street_id' => Crypt::encryptString($street->id),
            'edifice_number' => '123',
            'waste_management' => 'Incineration',
            'toilet' => 'Pail type',
            'dwelling_type' => 'Concrete',
            'ownership' => 'Rented'
        ];
        $response = $this->post(route('households.store'), $household);
        $this->assertEquals(1, $street->fresh()->household_count);
        $response->assertStatus(302);
        $this->assertDatabaseHas('households', [
            'edifice_number' => $household['edifice_number'],
            'postal_code' => '1001',
            'city' => 'Quiapo, Manila',
            'household_size' => 0,
            'income' => 0,
            'income_classification' => 'Poor',
            'waste_management' => $household['waste_management'],   
            'toilet' => $household['toilet'],
            'dwelling_type' => $household['dwelling_type'],
            'ownership' => $household['ownership']
        ]);

    }
}
